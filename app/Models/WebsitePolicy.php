<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePolicy extends Model
{
    use HasFactory;

    protected $table = 'website_policy';

    protected $fillable = [
        'title',
        'description',
    ];

    // กำหนดให้ไม่ใช้ auto-increment
    public $incrementing = false;
}
