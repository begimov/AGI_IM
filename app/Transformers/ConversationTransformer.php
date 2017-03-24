<?php

namespace App\Transformers;

use App\Conversation;

class ConversationTransformer extends League\Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'replies',
        'user',
        'users',
        'parent'
    ];

    public function transform(Conversation $c)
    {
      return [
        'id' => $c->id,
        'parent_id' => $c->parentConversation() ? $c->parentConversation()->id : null,
        'body' => $c->body,
        'created_at_human' => $c->created_at->diffForHumans(),
        'last_reply_human' => $c->last_reply ? $c->last_reply->diffForHumans() : null,
        'participant_count' => $c->usersExceptCurrentlyAuthenticated()->count(),
      ];
    }

    public function includeReplies(Conversation $c)
    {
        $replies = $c->replies();
        return $this->collection($replies, new ConversationTransformer);
    }

    public function includeParent(Conversation $c)
    {
        $parent = $c->parentConversation();
        return $this->item($parent, new ConversationTransformer);
    }

    public function includeUser(Conversation $c)
    {
        $user = $c->user();
        return $this->item($user, new UserTransformer);
    }

    public function includeUsers(Conversation $c)
    {
        $users = $c->users();
        return $this->collection($users, new UserTransformer);
    }
}
