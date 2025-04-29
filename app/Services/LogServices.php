<?php

namespace App\Services;

use App\Models\Log;

class LogServices
{
    public function createLog( $action, $description,$userId)
    {
        return Log::create([
            'action' => $action,
            'description' => $description,
            'user_id' => $userId,
        ]);
    }

    public function getLogs()
    {
        return Log::with('user')
        ->orderBy('created_at', 'desc')
        ->get();
    }
}