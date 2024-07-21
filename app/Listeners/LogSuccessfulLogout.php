<?php
namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $user    = $event->user;
        $logType = $this->determineLogType();

        if ($user) {
            ActivityLog::create([
                'user_id'     => $user->id,
                'action'      => 'logout',
                'description' => json_encode(['message' => 'User logged out']),
                'log_type'    => $logType,
            ]);
        }
    }

    private function determineLogType()
    {
        if (Request::is('admin/*')) {
            return 'backend';
        }

        return 'frontend';
    }
}
