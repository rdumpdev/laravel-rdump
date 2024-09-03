<?php

namespace RDumpDev\RDump;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class RDump
{
    public static function dump(string $action, mixed $data): void
    {
        try {
            $backtrace = debug_backtrace();
            $caller = $backtrace[1];

            $e = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => config('rdump.private_key'),
            ])
                ->post(config('rdump.url'), [
                    'file' => $caller['file'],
                    'line' => $caller['line'],
                    'dump' => json_encode($data),
                    'action' => $action,
                ]);

        } catch (ConnectionException|\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Could not send dump to server ' . $e->getMessage());
        }
    }
}
