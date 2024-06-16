<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Curriculum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    public function pdf($curriculum_id)
    {
        /************ ส่วนของการสร้าง verify certificate  *************/
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // ค้นหา หลักสูตรที่ออกใบ cert
        $curriculum = Curriculum::find($curriculum_id);
        if (!$curriculum) {
            abort(404, 'Curriculum not found.');
        }

        $courseName  = $curriculum->name;
        $currentYear = Carbon::now()->year + 543;

        // ค้นหา running number สูงสุดของปีปัจจุบันสำหรับผู้ใช้และเพิ่มหนึ่ง
        $maxRunningNumber = Certificate::whereYear('issued_at', Carbon::now()->year)
            ->max('running_number');
        $runningNumber          = $maxRunningNumber ? $maxRunningNumber + 1 : 1;
        $formattedRunningNumber = $runningNumber . '/' . $currentYear;

        // คำนวณวันหมดอายุ 3 ปีหลังจากวันที่ออก และเป็นวันสุดท้ายของปี (31 ธันวาคม)
        $expiresAt         = Carbon::now()->addYears(3)->endOfYear();
        $expiresAtThaiYear = $expiresAt->format('d/m') . '/' . ($expiresAt->year + 543);

        // บันทึกใบประกาศนียบัตรใหม่ในฐานข้อมูล
        $certificate = Certificate::create([
            'user_id'        => $user->id,
            'curriculum_id'  => $curriculum->id,
            'running_number' => $runningNumber,
            'issued_at'      => Carbon::now(),
            'expires_at'     => $expiresAt,
            'verify_token'   => bin2hex(random_bytes(16)),
        ]);

        /************ ส่วนของการสร้าง verify certificate  *************/

        /************ ข้อมูลสำหรับโชว์ในใบประกาศนียบัตร  *************/
        $data = [
            'title'          => 'ขอมอบประกาศนียบัตรฉบับนี้เพื่อแสดงว่า',
            'name'           => $user->prefix . $user->first_name . ' ' . $user->last_name,
            'description'    => 'ได้ผ่านการเรียนรู้ด้วยตนเองในรูปแบบออนไลน์ (e-Learning)',
            'course'         => $courseName,
            'date'           => $this->getFormattedDate(),
            'running_number' => $formattedRunningNumber,
            'expires_at'     => $expiresAtThaiYear, // รูปแบบวันหมดอายุเป็นปีไทย
        ];
        /************ ดึงข้อมูลสำหรับโชว์ในใบประกาศนียบัตร  *************/

        /************ ทำ qrcode สำหรับสแกน  *************/
        // เข้ารหัสข้อมูลเป็น parameter เดียว
        $verifyTokenData = [
            'verify_token'   => $certificate->verify_token,
            'name'           => $data['name'],
            'course'         => $data['course'],
            'date'           => $data['date'],
            'running_number' => $data['running_number'],
            'expires_at'     => $data['expires_at'],
        ];
        $encodedVerifyToken = base64_encode(json_encode($verifyTokenData));

        // สร้างข้อมูลลับสำหรับฝังใน QR Code
        $secretData = [
            'verify_url' => route('certificate.verify', ['encoded_token' => $encodedVerifyToken]),
        ];

        // สร้าง QR Code และแปลงเป็น Base64 image
        $qrcode = base64_encode(
            QrCode::format('png')
                ->size(200)
                ->margin(1)
                ->errorCorrection('H')
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->style('dot')
                ->eye('circle')
                ->generate(json_encode($secretData))
        );

        // เพิ่ม QR Code ลงในข้อมูลที่ส่งไปยัง view
        $data['qrcode'] = $qrcode;
        /************ ทำ qrcode สำหรับสแกน  *************/

        $pdf = PDF::loadView('frontend.certificate.pdf', $data);

        $pdf->setPaper([0, 0, 3508, 2480]);

        return $pdf->stream('certificate.pdf');
    }

    private function getFormattedDate()
    {
        // กำหนดวันที่ปัจจุบัน
        $date = Carbon::now();

        // แปลงวันที่เป็นรูปแบบที่ต้องการ
        $day   = $date->day;
        $month = $this->convertMonth($date->month);
        $year  = $date->year + 543; // แปลงเป็นปี พ.ศ.

        return "ให้ไว้ ณ วันที่ $day เดือน $month พ.ศ. $year";
    }

    private function convertMonth($month)
    {
        // แปลงหมายเลขเดือนเป็นชื่อเดือนภาษาไทย
        $months = [
            1  => 'มกราคม',
            2  => 'กุมภาพันธ์',
            3  => 'มีนาคม',
            4  => 'เมษายน',
            5  => 'พฤษภาคม',
            6  => 'มิถุนายน',
            7  => 'กรกฎาคม',
            8  => 'สิงหาคม',
            9  => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        return $months[$month];
    }

    public function verify($encodedToken)
    {
        $decodedToken = json_decode(base64_decode($encodedToken), true);

        $certificate = Certificate::where('verify_token', $decodedToken['verify_token'])->firstOrFail();

        $expiresAtThaiYear = $certificate->expires_at->format('d/m') . '/' . ($certificate->expires_at->year + 543);

        return response()->json([
            'id'                     => $certificate->id,
            'user'                   => $certificate->user->name,
            'course_name'            => $certificate->curriculum->name,
            'issued_at'              => $certificate->issued_at,
            'running_number'         => $certificate->running_number,
            'expires_at'             => $expiresAtThaiYear,
            'name_from_qr'           => $decodedToken['name'],
            'course_from_qr'         => $decodedToken['course'],
            'date_from_qr'           => $decodedToken['date'],
            'running_number_from_qr' => $decodedToken['running_number'],
            'expires_at_from_qr'     => $decodedToken['expires_at'],
        ]);
    }
}
