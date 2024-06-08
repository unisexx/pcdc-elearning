<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumLessonQuestionAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'curriculum_lesson_question_answers';

    protected $fillable = [
        'curriculum_lesson_question_id',
        'name',        
        'score',     
        'pos',   
        'status',
        'deleted_at',
    ];

    public function curriculum_lesson_question() { return $this->belongsTo(CurriculumLessonQuestion::class);}    
}
