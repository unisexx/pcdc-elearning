<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    public function pdf()
    {
        // ดึงข้อมูลที่ต้องการแสดงในใบประกาศนียบัตร
        $data = [
            'title'       => 'ขอมอบประกาศนียบัตรฉบับนี้เพื่อแสดงว่า',
            'name'        => 'John Doe สวัสดี',
            'description' => 'ได้ผ่านการเรียนรู้ด้วยตนเองในรูปแบบออนไลน์ (e-Learning)',
            'course'      => 'Laravel Basics',
            'date'        => $this->getFormattedDate(),
        ];

        // สร้างข้อมูลลับสำหรับฝังใน QR Code
        $secretData = [
            'name'       => $data['name'],
            'course'     => $data['course'],
            'date'       => $data['date'],
            'verify_url' => route('certificate.verify', ['id' => 123]), // URL สำหรับการตรวจสอบใบประกาศนียบัตร
        ];

        // สร้าง QR Code และแปลงเป็น Base64 image
        $qrcode = base64_encode(QrCode::format('png')->size(200)->generate(json_encode($secretData)));

        // เพิ่ม QR Code ลงในข้อมูลที่ส่งไปยัง view
        $data['qrcode'] = $qrcode;

        // โหลด view และส่งข้อมูลไปที่ view
        $pdf = PDF::loadView('frontend.certificate.pdf', $data);

        // ส่งออก PDF
        return $pdf->download('certificate.pdf');
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

    public function verify($id)
    {
        // เพิ่มโค้ดสำหรับการตรวจสอบใบประกาศนียบัตรจาก ID
        // ตัวอย่าง:
        return "Verification page for certificate ID: " . $id;
    }
}
