<?php

namespace App\Models\Traits;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

trait Logable
{
    public function logs()
    {
        return $this->morphMany(Log::class, 'logable');
    }

    public function makeLog(Model $log, string $method)
    {
        return $this->logs()->create([
            'user_id' => $log->user_id,
            'action_type' => $method,
        ]);
    }
}
