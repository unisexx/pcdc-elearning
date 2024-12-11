<?php

namespace App\Exports;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SurveyExport implements FromView, WithEvents
{
    public function view(): View
    {
        $surveyResults = DB::table('survey_results')
            ->select('survey_id', DB::raw('rating, COUNT(*) as count'))
            ->groupBy('survey_id', 'rating')
            ->get();

        $groupedResults = $surveyResults->groupBy('survey_id');

        // ดึงข้อมูล surveys ทั้งหมด
        $surveys = Survey::all();

        return view('export.excel.survey', compact('groupedResults', 'surveys'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // ตั้งค่าความกว้างของคอลัมน์
                $sheet = $event->sheet->getDelegate();
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true); // ปรับความกว้างอัตโนมัติ
                }
            },
        ];
    }
}
