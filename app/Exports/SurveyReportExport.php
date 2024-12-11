<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\SurveyResult;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SurveyReportExport implements FromArray, WithHeadings
{
    protected $surveyTitles;
    protected $data;

    public function __construct()
    {
        // ตั้ง memory_limit เป็น -1 เพื่อไม่จำกัดหน่วยความจำ
        ini_set('memory_limit', '-1');

        // ดึงหัวข้อ (title) ของแบบสำรวจที่ active
        $this->surveyTitles = Survey::where('status', 'active')->pluck('title', 'id')->toArray();

        // เตรียมข้อมูลสำหรับ Excel โดยใช้ chunk
        $this->data = $this->fetchData();
    }

    /**
     * กำหนดหัวคอลัมน์ในไฟล์ Excel
     *
     * @return array
     */
    public function headings(): array
    {
        // เพิ่ม Timestamp, User Type, Province, Curriculum, Survey Titles, และ Suggestion
        $headers = [
            'เวลา',
            'ประเภทผู้ใช้งาน',
            'จังหวัด',
            'หลักสูตร',
        ];
        return array_merge($headers, array_values($this->surveyTitles), ['ข้อเสนอแนะ']);
    }

    /**
     * เตรียมข้อมูลสำหรับใส่ในไฟล์ Excel
     *
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * ดึงข้อมูลโดยใช้ chunk
     *
     * @return array
     */
    protected function fetchData(): array
    {
        $data = [];

        // ใช้ chunk เพื่อลดการใช้หน่วยความจำ
        SurveyResult::with('user.userType', 'user.province', 'curriculum')
            ->select('user_id', 'curriculum_id', 'survey_id', 'rating', 'suggestion', 'created_at')
            ->chunk(1000, function ($results) use (&$data) {
                $groupedResults = $results->groupBy(['user.userType.name', 'curriculum.name']); // จัดกลุ่ม

                foreach ($groupedResults as $userTypeName => $curriculums) {
                    foreach ($curriculums as $curriculumName => $surveys) {
                        // สร้างข้อมูลแถว (row) ใหม่
                        $row = [
                            'timestamp' => $surveys->first()->created_at->format('Y-m-d H:i:s') ?? '-', // เวลาที่สร้าง
                            'user_type' => $userTypeName ?? '-',                                        // ประเภทผู้ใช้งาน
                            'province' => $surveys->first()->user->province->name ?? '-',               // ชื่อจังหวัด
                            'curriculum_name' => $curriculumName ?? '-',                                // ชื่อหลักสูตร
                        ];

                        // เติมค่าคะแนน (rating) สำหรับแต่ละ survey_id
                        foreach (array_keys($this->surveyTitles) as $surveyId) {
                            $row[$surveyId] = $surveys->where('survey_id', $surveyId)->first()->rating ?? '-';
                        }

                        // เพิ่มฟิลด์ "ข้อเสนอแนะ" จาก SurveyResult
                        $row['suggestion'] = $surveys->first()->suggestion ?? '-';

                        $data[] = $row;
                    }
                }
            });

        return $data;
    }
}
