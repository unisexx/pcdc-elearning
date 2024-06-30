<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Curriculum;
use App\Models\UserCurriculumPpExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    public function pdf($curriculum_id)
    {
        ini_set('max_execution_time', -1);
        ini_set("memory_limit", "-1");
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

        //ตรวจสอบว่า user ผ่าน posttest ของ หลักสูตรนั้นจริงไหม
        $pass_posttest = UserCurriculumPpExam::where('user_id',$user->id)->where('curriculum_id',$curriculum_id)->whereRaw('n_question = total_question and pass_score <= total_score')->first();
        if(!$pass_posttest){
            abort(404, 'Curriculum Post-Test not pass.');
        }

        $courseName  = $curriculum->name;
        $currentYear = Carbon::now()->year + 543;

        // ตรวจสอบว่ามี certificate ที่ออกให้ผู้ใช้และหลักสูตรนี้แล้วหรือไม่
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('curriculum_id', $curriculum->id)
            ->whereYear('issued_at', Carbon::now()->year)
            ->first();

        if ($existingCertificate) {
            // ใช้ running number เดิม
            $runningNumber = $existingCertificate->running_number;
        } else {
            // ค้นหา running number สูงสุดของปีปัจจุบันสำหรับผู้ใช้และเพิ่มหนึ่ง
            $maxRunningNumber = Certificate::whereYear('issued_at', Carbon::now()->year)
                ->max('running_number');
            $runningNumber = $maxRunningNumber ? $maxRunningNumber + 1 : 1;
        }

        $formattedRunningNumber = $runningNumber . '/' . $currentYear;

        // คำนวณวันหมดอายุ 3 ปีหลังจากวันที่ออก และเป็นวันสุดท้ายของปี (31 ธันวาคม)
        $expiresAt         = Carbon::now()->addYears(3)->endOfYear();
        $expiresAtThaiYear = ($expiresAt->year + 543);

        if (!$existingCertificate) {
            // บันทึกใบประกาศนียบัตรใหม่ในฐานข้อมูล
            $certificate = Certificate::create([
                'user_id'        => $user->id,
                'curriculum_id'  => $curriculum->id,
                'running_number' => $runningNumber,
                'issued_at'      => Carbon::now(),
                'expires_at'     => $expiresAt,
                'verify_token'   => bin2hex(random_bytes(16)),
            ]);
        } else {
            $certificate = $existingCertificate;
        }

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

        /************ ทำ qrcode สำหรับสแกน verify *************/
        $qrcode = base64_encode(
            QrCode::format('svg')
                ->size(300)
                ->margin(2)
                ->errorCorrection('L')
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)->generate(route('certificate.verify', ['verifyToken' => $certificate->verify_token]))
        );

        // เพิ่ม QR Code ลงในข้อมูลที่ส่งไปยัง view
        $data['qrcode'] = $qrcode;
        /************ ทำ qrcode สำหรับสแกน  *************/

        $pdf = PDF::loadView('frontend.certificate.pdf', $data);

        $pdf->setPaper([0, 0, 3508, 2480]);

        // การตั้งค่าฟอนต์ใน CSS
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
        ]);
                
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

    public function verify($verifyToken)
    {
        try {
            // ค้นหาใบประกาศนียบัตรด้วย verify token
            $certificate = Certificate::where('verify_token', $verifyToken)->firstOrFail();

            // แปลงวันหมดอายุและวันที่ออกเป็นวัตถุ Carbon
            $issuedAt  = Carbon::parse($certificate->issued_at);
            $expiresAt = Carbon::parse($certificate->expires_at);

            // แปลงวันหมดอายุเป็นปี พ.ศ.
            $expiresAtThaiYear = $expiresAt->format('d/m') . '/' . ($expiresAt->year + 543);

            // เตรียมข้อมูลสำหรับการตอบกลับ
            $data = [
                'id'             => $certificate->id,
                'user'           => $certificate->user->prefix . $certificate->user->first_name . ' ' . $certificate->user->last_name,
                'course_name'    => $certificate->curriculum->name,
                'issued_at'      => $issuedAt->format('d/m/Y'), // แปลงวันที่ออกใบประกาศ
                'running_number' => $certificate->running_number . '/' . ($issuedAt->format('Y') + 543),
                'expires_at'     => $expiresAtThaiYear,
            ];

            // ส่งข้อมูลไปยัง view
            return view('frontend.certificate.verify', compact('data'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // หากไม่พบใบประกาศนียบัตร ให้ตอบกลับด้วยข้อความข้อผิดพลาด
            return view('frontend.certificate.verify', ['error' => 'ใบประกาศนียบัตรไม่ถูกต้องหรือไม่พบข้อมูล']);
        }
    }
}
