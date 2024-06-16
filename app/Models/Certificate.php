<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curriculum_id',
        'issued_at',
        'running_number',
        'expires_at',
        'verify_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            $certificate->verify_token = Str::random(32); // สร้าง verify token
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
