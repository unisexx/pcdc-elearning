<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'order', 'category_id'];

    public function surveyResults()
    {
        return $this->hasMany(SurveyResult::class);
    }

    public function categotyTxt()
    {
        $array = ['1' => 'ด้านเนื้อหา', '2' => 'ด้านรูปแบบ', '3' => 'ด้านการนำไปใช้ประโยชน์'];
        return $array[$this->category_id];
    }
}
