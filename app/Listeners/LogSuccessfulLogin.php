<?php
namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $user    = $event->user;
        $logType = $this->determineLogType();

        ActivityLog::create([
            'user_id'     => $user->id,
            'action'      => 'login',
            'description' => json_encode(['message' => 'User logged in']),
            'log_type'    => $logType,
        ]);
    }

    private function determineLogType()
    {
        if (Request::is('admin/*')) {
            return 'backend';
        }

        return 'frontend';
    }
}
