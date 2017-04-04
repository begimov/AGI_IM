<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ConversationTransformer;
use App\Http\Requests\StoreConversationReply;

class ConversationReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreConversationReply $req, Conversation $conversation)
    {

        $this->authorize('reply', $conversation);

        $reply = new Conversation;

        $reply->body = $req->body;
        $reply->user()->associate($req->user());

        $conversation->replies()->save($reply);
        $conversation->touchLastReply();

        return fractal()
            ->item($reply)
            ->parseIncludes(['user'])
            ->transformWith(new ConversationTransformer)
            ->toArray();
    }
}
