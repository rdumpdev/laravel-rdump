<?php

namespace RDumpDev\RDump;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http;

class RDumpErrorHandler extends ExceptionHandler
{
    /**
     * @param \Throwable $e
     * @return void
     * @throws \Throwable
     */
    public function report(\Throwable $e)
    {
        if ($this->shouldReport($e) && config('rdump.report_errors')) {
            $this->sendErrorToRemote($e);
        }

        parent::report($e);
    }

    /**
     * Enviar el error a un endpoint remoto.
     *
     * @param Exception $exception
     * @return void
     */
    protected function sendErrorToRemote(\Throwable $exception): void
    {
        try {
            Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => config('rdump.private_key'),
            ])
                ->post(config('rdump.url'), [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'dump' => $exception->getTraceAsString(),
                    'type' => 'error',
                    'action' => 'error',
                ]);
        } catch (Exception $exception) {
        }
    }
}
