<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    /**
     * Kirim pesan ke n8n dan dapatkan balasan Gemini
     */
    public function askBot(string $userMessage)
    {
        try {
            // 1. Kirim Request ke n8n
            $response = Http::timeout(30)->post(env('N8N_CHATBOT_URL'), [
                'message' => $userMessage,
                'timestamp' => now()->toDateTimeString()
            ]);

            // 2. Cek jika gagal
            if ($response->failed()) {
                Log::error('Chatbot Error n8n:', ['body' => $response->body()]);
                return "Maaf, sistem sedang sibuk. Coba lagi nanti.";
            }

            // 3. Ambil balasan dari JSON n8n
            $data = $response->json();
            
            // Pastikan key 'reply' sesuai dengan settingan di node "Respond to Webhook" n8n
            return $data['reply'] ?? 'Tidak ada balasan dari AI.';

        } catch (\Exception $e) {
            Log::error('Chatbot Exception:', ['message' => $e->getMessage()]);
            return "Terjadi kesalahan koneksi pada server.";
        }
    }
}