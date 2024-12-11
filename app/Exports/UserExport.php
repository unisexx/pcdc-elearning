<?php

namespace App\Exports;

use App\Models\Curriculum;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    protected $curriculums;

    public function __construct()
    {
        // โหลดข้อมูลหลักสูตรเพียงครั้งเดียว
        $this->curriculums = Curriculum::with('curriculum_user_type.user_type')->where('status', 'active')->get();
    }

    /**
     * Query สำหรับดึงข้อมูลผู้ใช้
     */
    public function query()
    {
        return User::with('userType', 'province', 'district', 'subdistrict', 'UserCurriculumExamHistory');
    }

    /**
     * กำหนดหัวตาราง
     */
    public function headings(): array
    {
        $headers = [
            'ชื่อ',
            'อีเมล์',
            'ประเภทผู้ใช้งาน',
            'ชื่อโรงเรียน',
            'จังหวัด',
            'อำเภอ',
            'ตำบล',
        ];

        foreach ($this->curriculums as $curriculum) {
            $headers[] = $curriculum->name . ' (' . implode(
                ', ',
                $curriculum->curriculum_user_type->map(function ($item) {
                    return $item->user_type ? $item->user_type->name : '-';
                })->toArray()
            ) . ')';
        }

        return $headers;
    }

    /**
     * แมปข้อมูลแต่ละ record สำหรับ export
     */
    public function map($user): array
    {
        $row = [
            $user->name ?? '-',
            $user->email ?? '-',
            $user->userType->name ?? '-',
            $user->school_name ?? '-',
            $user->province->name ?? '-',
            $user->district->name ?? '-',
            $user->subdistrict->name ?? '-',
        ];

        foreach ($this->curriculums as $curriculum) {
            $history = collect($user->UserCurriculumExamHistory)->firstWhere('curriculum_id', $curriculum->id);
            $row[]   = $history ? ($history->post_pass_status === 'y' ? 'ผ่าน' : 'ไม่ผ่าน') : '-';
        }

        return $row;
    }

    /**
     * กำหนด chunk size
     */
    public function chunkSize(): int
    {
        return 1000; // เปลี่ยนค่าได้ตามความเหมาะสม
    }
}
