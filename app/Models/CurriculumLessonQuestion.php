<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumLessonQuestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'curriculum_lesson_questions';

    protected $fillable = [
        'curriculum_lesson_id',
        'name',        
        'suggestion',     
        'pos',   
        'status',
        'deleted_at',
    ];

    public function curriculum_lesson() { return $this->belongsTo(CurriculumLesson::class);}

    public function curriculum_lesson_question_answer() { return $this->hasMany('App\Models\CurriculumLessonQuestionAnswer','curriculum_lesson_question_id','id'); }
}
