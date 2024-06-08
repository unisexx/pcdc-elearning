<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumLesson extends Model
{
    use HasFactory;
    protected $table = 'curriculum_lessons';

    protected $fillable = [
        'curriculum_id',
        'name',        
        'description',     
        'pos',   
        'status',
        'deleted_at',
    ];

    public function curriculum() { return $this->belongsTo(Curriculum::class);}

    public function curriculum_lesson_detail() { return $this->hasMany('App\Models\CurriculumLessonDetail','curriculum_lesson_id','id'); }

    public function curriculum_lesson_question() { return $this->hasMany('App\Models\CurriculumLessonQuestion','curriculum_lesson_id','id'); }
}
