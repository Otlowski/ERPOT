<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function showChat() {
        
        return view('Chat.index');
    }
    
    public function listMessages() {
        
    }
}
