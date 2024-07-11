<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumCategory extends Model
{
    use HasFactory;
    protected $table = 'curriculum_categories';

    protected $fillable = [        
        'name',     
        'description',                   
        'pos',   
        'status',
        'deleted_at',
    ];
    public function curriculum() { return $this->hasMany('App\Models\Curriculum','curriculum_category_id','id'); }    
}
