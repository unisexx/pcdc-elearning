<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->subDays(30);
        $rs   = ActivityLog::where('created_at', '>=', $date)->orderBy('id', 'desc')->paginate(5);

        return view('admin.log.index', compact('rs'));
    }
}
