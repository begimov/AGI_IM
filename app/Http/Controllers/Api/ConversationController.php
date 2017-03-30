<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ConversationTransformer;
use App\Conversation;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $conversations = $req->user()->conversations()->get();

        return fractal()
            ->collection($conversations)
            ->parseIncludes(['user', 'users'])
            ->transformWith(new ConversationTransformer)
            ->toArray();
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        if ($conversation->isReply()) {
            abort(404);
        }

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users', 'replies', 'replies.user'])
            ->transformWith(new ConversationTransformer)
            ->toArray();
    }
}
