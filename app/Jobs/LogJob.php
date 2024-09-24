<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogJob implements ShouldQueue
{
    use Queueable;

    protected $log;
    protected $method;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $log, string $method)
    {
        $this->log = $log;
        $this->method = $method;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->log->makeLog($this->log, $this->method);
    }
}
