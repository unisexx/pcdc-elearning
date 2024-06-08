<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CurriculumExamSettingDetail extends Model
{
    use HasFactory;
    protected $table = 'curriculum_exam_setting_details';

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->attributes['created_by'] = @\Auth::user()->full_name;
            $model->attributes['updated_by'] = @\Auth::user()->full_name;
        });

        static::updating(function($model)
        {
            $model->attributes['updated_by'] = @\Auth::user()->full_name;
        });
    }

    protected $fillable = [
        'curriculum_exam_setting_id',
        'curriculum_lesson_id',
        'curriculum_exam_setting_id',
        'curriculum_lesson_id',
        'exam_status',
        'question_random_status',
        'n_question',
        'pass_score',
        'n_prepost_lesson_question',
    ];

    public function curriculum_lesson() { return $this->hasOne('App\Models\CurriculumLesson','curriculum_lesson_id','id'); }
    
    public function curriculum_exam_setting() { return $this->belongsTo('App\Models\CurriculumExamSetting');}
}
