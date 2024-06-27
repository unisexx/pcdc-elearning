<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UserCurriculumPpExam extends Model
{
    use HasFactory;
    protected $table = 'user_curriculum_pp_exams';

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
        'user_id',
        'exam_type',        
        'curriculum_id',                  
    ];
    
    
    public function curriculum() { return $this->belongTo(Curriculum::class);}
    public function user_curriculum_pp_exam_qas() { return $this->hasMany('App\Models\UserCurriculumPpExamQas','user_curriculum_pp_exam_id','id'); }
}
