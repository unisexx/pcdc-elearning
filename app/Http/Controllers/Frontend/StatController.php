<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Curriculum;
use App\Models\UserType;
use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;

class StatController extends Controller
{
    public function index()
    {
        /** หลักสูตร */
        $curriculum_list = Curriculum::where('status', 'active')->orderBy('pos', 'asc')->pluck('name','id');

        $user_type = UserType::where('status', '1')->orderBy('pos', 'asc')->pluck('name','id');
        
        $min_year = getenv('MIN_YEAR');
        $min_year = empty($min_year) ? date("Y") + 543 : $min_year;

        $provinces = Province::orderBy('name', 'asc')->pluck('name','id');
        $districts = @$_GET['province_id'] ? District::whereRaw('left(id,2) = '.$_GET['province_id'])->orderBy('name', 'asc')->pluck('name','id') : [];
        $subdistricts = @$_GET['district_id']  ? Subdistrict::whereRaw('left(id,4) = '.$_GET['district_id'])->orderBy('name', 'asc')->pluck('name','id') : [];

        return view('frontend.stat.index', compact('curriculum_list', 'user_type', 'min_year', 'provinces', 'districts', 'subdistricts'));
    }
}
