<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookiePolicy extends Model
{
    use HasFactory;

    protected $table = 'cookie_policy';

    protected $fillable = [
        'title',
        'description',
    ];

    // กำหนดให้ไม่ใช้ auto-increment
    public $incrementing = false;
}
