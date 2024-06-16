<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function form()
    {
        $surveys = Survey::where('status', 'active')->orderBy('order', 'asc')->get();
        return view('frontend.survey.form', compact('surveys'));
    }

    public function submit(Request $request)
    {
        // กำหนดกฎ validation แบบ dynamic
        $rules = [
            'suggestion'    => 'nullable|string',
            'curriculum_id' => 'required|integer',
        ];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'question') !== false) {
                $rules[$key] = 'required|integer|between:1,5';
            }
        }

        $data = $request->validate($rules);

        // ดึงข้อมูล survey ID
        $responses = [];
        foreach ($data as $key => $value) {
            if (strpos($key, 'question') !== false) {
                $surveyId    = str_replace('question', '', $key);
                $responses[] = [
                    'survey_id'     => $surveyId,
                    'rating'        => $value,
                    'suggestion'    => $data['suggestion'] ?? null,
                    'user_id'       => Auth::id(),
                    'curriculum_id' => $data['curriculum_id'],
                ];
            }
        }

        // บันทึกข้อมูลลงในตาราง survey_results
        foreach ($responses as $response) {
            SurveyResult::create($response);
        }

        return response()->json(['success' => true]);
    }
}
