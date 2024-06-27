<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UserCurriculumPpExamQas extends Model
{
    use HasFactory;
    protected $table = 'user_curriculum_pp_exam_qas';

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
        'user_curriculum_pp_exam_id',
        'curriculum_lesson_question_id',
        'curriculum_lesson_answer_id',
    ];
    
    // public function curriculum_user_type() { return $this->hasMany('App\Models\CurriculumUserType','curriculum_id','id'); }
    public function user_curriculum_pp_exam() { return $this->belongTo(UserCurriculumPpExam::class);}
    public function curriculum_lesson_question() { return $this->hasOne(CurriculumLessonQuestion::class,'id', 'curriculum_lesson_question_id');}
}
