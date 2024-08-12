<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumLessonDetail extends Model
{
    use HasFactory;
    protected $table = 'curriculum_lesson_details';

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
        'curriculum_lesson_id',          
        'name',
        'detail',     
        'pos',   
        'status',
        'deleted_at',
    ];

    public function curriculum_lesson() { return $this->belongsTo(CurriculumLesson::class);}
}
