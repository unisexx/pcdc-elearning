<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hilight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'description',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($hilight) {
            if (empty($hilight->link)) {
                $hilight->link = 'temp-link';
            }
        });

        static::saved(function ($hilight) {
            if ($hilight->link === 'temp-link') {
                $hilight->link = '/hilight/view/' . $hilight->id;
                $hilight->saveQuietly();
            }
        });
    }
}
