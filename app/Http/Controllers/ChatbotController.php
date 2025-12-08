<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatbotService;

class ChatbotController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function index()
    {
        // PERUBAHAN DISINI:
        // Menggunakan pola wrapper project Anda (seperti DashboardController)
        return view('admin.layouts.wrapper', [
            'content' => 'admin.chatbot.index'
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $reply = $this->chatbotService->askBot($request->message);

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }
}