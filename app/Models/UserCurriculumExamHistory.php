<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UserCurriculumExamHistory extends Model
{
    use HasFactory;
    protected $table = 'user_curriculum_exam_histories';

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
        'curriculum_id',
        'post_date_started',        
        'post_date_finished',      
        'post_pass_status',      
    ];
    
    public function user() { return $this->hasOne('App\Models\User','user_id','id'); }
    public function curriculum() { return $this->hasOne('App\Models\Curriculum','id','curriculum_id'); }
    public function user_curriculum_pp_exam() { return $this->hasMany('App\Models\UserCurriculumPpExam','user_curriculum_exam_history_id','id'); }
}
