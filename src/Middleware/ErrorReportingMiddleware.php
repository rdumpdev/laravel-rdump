<?php

namespace RDumpDev\RDump\Middleware;

use Closure;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Http;

class ErrorReportingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = $next($request);
        } catch (Throwable $exception) {
            $this->reportError($exception);
            throw $exception;
        }

        if (isset($response->exception) && $response->exception instanceof Throwable) {
            $this->reportError($response->exception);
        }

        return $response;
    }

    protected function reportError(Throwable $exception): void
    {
        try {
            $e = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => config('rdump.private_key'),
            ])
                ->timeout(1)
                ->retry(0)
                ->connectTimeout(1)
                ->post(config('rdump.url'), [
                    'type' => 'error',
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'dump' => json_encode([
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTraceAsString(),
                        'url' =>  request()?->fullUrl() ?? null,
                    ]),
                    'action' => request()?->method() ?? 'error',
                ]);
        } catch (\Exception $e) {
            \Log::error('Fail while sending error to rdump.dev: ' . $e->getMessage());
        }
    }
}
