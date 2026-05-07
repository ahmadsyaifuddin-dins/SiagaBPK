<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    public static function sendMessage($target, $message)
    {
        $token = env('FONNTE_TOKEN');

        if (! $token) {
            Log::error('Fonnte Token is missing in .env!');

            return false;
        }

        try {
            if (is_array($target)) {
                $target = implode(',', $target);
            }

            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Fonnte API Error: '.$e->getMessage());

            return false;
        }
    }
}
