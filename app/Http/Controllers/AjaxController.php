<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{
    public function getProvinces($area_id)
    {
        // ดึงข้อมูลจังหวัด จาก สคร
        $provinces = Province::where('prevention_office_id', $area_id )->orderBy('id', 'asc')->pluck('name', 'id');

        // ส่งข้อมูลในรูปแบบ JSON response
        return response()->json($provinces);
    }

    public function getDistricts($province)
    {
        // ดึงข้อมูลอำเภอที่ id เริ่มต้นด้วยเลขของจังหวัด
        $districts = District::where('id', 'like', $province . '%')->orderBy('id', 'asc')->pluck('name', 'id');

        // ส่งข้อมูลในรูปแบบ JSON response
        return response()->json($districts);
    }

    public function getSubdistricts($district)
    {
        // ดึงข้อมูลตำบลที่ id เริ่มต้นด้วยเลขของอำเภอ
        $subdistricts = Subdistrict::where('id', 'like', $district . '%')->orderBy('id', 'asc')->pluck('name', 'id');

        // ส่งข้อมูลในรูปแบบ JSON response
        return response()->json($subdistricts);
    }

    public function ajaxGetZipCode(Request $request)
    {
        // cache 1 วัน
        $zipCodeData = Cache::remember('zip_code_array', 1440, function () {
            $jsonFilePath = public_path('json/zip_code.json');
            if (file_exists($jsonFilePath)) {
                $jsonData   = file_get_contents($jsonFilePath);
                $dataArray  = json_decode($jsonData, true);
                $collection = collect($dataArray);
            }

            return $collection;
        });

        // ค้นหาข้อมูลที่ตรงกับเงื่อนไข
        $result = $zipCodeData->where('district', $request->district)
            ->where('amphoe', $request->amphoe)
            ->where('province', $request->province);
        // dd($result);

        // หากพบข้อมูลที่ตรงกับเงื่อนไข
        if ($result->isNotEmpty()) {
            // ดึงค่า zipcode จากผลลัพธ์ที่พบ (สมมติว่ามีเพียงรายการเดียว)
            $zipcode = $result->first()['zipcode'];
        }

        return @$zipcode;
    }

}
