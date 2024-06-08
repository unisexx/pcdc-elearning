<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CurriculumExamSetting extends Model
{
    use HasFactory;
    protected $table = 'curriculum_exam_settings';

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
        'curriculum_id',
        'prepost_pass_score',
        'pre_test_status',
        'post_test_status',
    ];

    public function curriculum_exam_setting_detail() { return $this->hasMany('App\Models\CurriculumExamSettingDetail','curriculum_exam_setting_id','id'); }
}
