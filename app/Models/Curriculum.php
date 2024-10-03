<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'curriculums';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->attributes['created_by'] = @\Auth::user()->full_name;
            $model->attributes['updated_by'] = @\Auth::user()->full_name;
        });

        static::updating(function ($model) {
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

    // Scope สำหรับกรองตามสถานะการล็อกอินของผู้ใช้
    public function scopeFilterByUserType($query)
    {
        if (Auth::check()) {
            // ถ้าผู้ใช้ล็อกอินแล้ว
            return $query->whereHas('curriculum_user_type', function ($q) {
                $userTypeId = Auth::user()->user_type_id;

                if (empty($userTypeId)) {
                    // ถ้า user_type_id เป็นค่าว่าง ให้ใช้ค่า 4
                    $q->where('user_type_id', 4);
                } else {
                    // ถ้า user_type_id ไม่ว่าง ให้ใช้ค่าจากผู้ใช้
                    $q->where('user_type_id', $userTypeId);
                }
            });
        } else {
            // ถ้าผู้ใช้ยังไม่ได้ล็อกอิน
            return $query->whereHas('curriculum_user_type', function ($q) {
                $q->where('user_type_id', 4);
            });
        }
    }

    public function curriculum_lesson()
    {return $this->hasMany('App\Models\CurriculumLesson', 'curriculum_id', 'id');}
    public function curriculum_user_type()
    {return $this->hasMany('App\Models\CurriculumUserType', 'curriculum_id', 'id');}
    public function curriculum_exam_setting()
    {return $this->hasOne(CurriculumExamSetting::class);}
    public function curriculum_category()
    {return $this->hasOne('App\Models\CurriculumCategory', 'id', 'curriculum_category_id');}

    public function user_types()
    {
        return $this->hasMany(UserType::class, 'curriculum_id', 'id');
    }
}
