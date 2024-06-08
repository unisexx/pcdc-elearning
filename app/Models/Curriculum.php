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
        'intro',        
        'objective',        
        'status',
        'deleted_at',
    ];

    public function curriculum_lesson() { return $this->hasMany('App\Models\CurriculumLesson','curriculum_id','id'); }
}
