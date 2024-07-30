<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private LoggerInterface $logger;

    protected function __construct()
    {
        $this->logger = Log::channel('error');
    }

    protected function log(string $method, Throwable $th)
    {
        $message = static::class . "@{$method} - {$th}";

        $this->logger->error($message);
    }
}