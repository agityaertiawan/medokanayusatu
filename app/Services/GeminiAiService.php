<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAiService
{
    /**
     * Generate konten berita berdasarkan topik yang diberikan user.
     */
    public function generateNewsContent(string $topic, string $tone = 'profesional'): ?string
    {
        $apiKey = config('services.gemini.api_key');
        // Kita menggunakan gemini-1.5-flash karena cepat dan gratis
        $endpoint = config('services.gemini.base_url') . "gemini-1.5-flash:generateContent?key={$apiKey}";

        $prompt = "Kamu adalah seorang jurnalis senior. Buatkan draft artikel berita dengan nada {$tone} mengenai topik berikut: '{$topic}'. 
                   Berikan judul yang menarik di baris pertama, lalu ikuti dengan 3-4 paragraf isi berita. Gunakan bahasa Indonesia yang baku dan jurnalistik.";

        try {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($endpoint, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

            if ($response->successful()) {
                // Mengambil struktur teks dari response JSON Gemini
                return $response->json('candidates.0.content.parts.0.text');
            }

            // Log error jika API gagal
            Log::error('Gemini API Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            return null;
        }
    }
}