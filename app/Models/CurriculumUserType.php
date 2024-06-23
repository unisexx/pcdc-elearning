<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CurriculumUserType extends Model
{
    use HasFactory;
    protected $table = 'curriculum_user_types';

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
        'user_type_id',
    ];

    public function curriculum() { return $this->belongsTo('App\Models\Curriculum'); }
    public function user_type() { return $this->belongsTo('App\Models\UserType'); }
}
