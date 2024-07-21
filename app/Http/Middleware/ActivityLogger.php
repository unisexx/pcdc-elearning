<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $user        = Auth::user();
            $action      = $request->route()->getActionMethod();
            $routeName   = $request->route()->getName();
            $description = $request->all();
            $logType     = $this->determineLogType($request);

            $actionsToLog = ['store', 'update', 'destroy'];

            if (in_array($action, $actionsToLog)) {
                ActivityLog::create([
                    'user_id'     => $user->id,
                    'action'      => $action,
                    'description' => json_encode($description),
                    'log_type'    => $logType,
                ]);
            }
        }

        return $response;
    }

    private function determineLogType($request)
    {
        // ตรวจสอบว่ามีเส้นทางอยู่ในกลุ่ม admin หรือไม่
        if ($request->is('admin/*')) {
            return 'backend';
        }

        return 'frontend';
    }
}
