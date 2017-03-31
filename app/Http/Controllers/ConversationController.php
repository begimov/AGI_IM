<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
        return view('conversations.index');
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);
        return view('conversations.index', compact('conversation'));
    }
}
