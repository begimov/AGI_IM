<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ConversationTransformer;
use App\Conversation;
use App\Http\Requests\StoreConversation;

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

    public function store(StoreConversation $req)
    {
        // validate via form request Requests/StoreConversation
        $conversation = new Conversation;
        $conversation->body = $req->body;
        $conversation->user()->associate($req->user());
        $conversation->save();
        $conversation->touchLastReply();
        //attach all users passed in via request
        $conversation->users()->sync(array_unique(
            array_merge($req->recipients, [$req->user()->id])
        ));

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users', 'replies', 'replies.user'])
            ->transformWith(new ConversationTransformer)
            ->toArray();
    }
}
