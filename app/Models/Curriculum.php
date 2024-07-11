<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'curriculums';

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
        'name',
        'curriculum_category_id',
        'intro',        
        'objective',  
        'pass_criteria',      
        'cover_image',
        'status',
        'deleted_at',
    ];

    public function curriculum_lesson() { return $this->hasMany('App\Models\CurriculumLesson','curriculum_id','id'); }
    public function curriculum_user_type() { return $this->hasMany('App\Models\CurriculumUserType','curriculum_id','id'); }
    public function curriculum_exam_setting() { return $this->hasOne(CurriculumExamSetting::class);}
    public function curriculum_category() { return $this->hasOne('App\Models\CurriculumCategory','id', 'curriculum_category_id'); }
}
