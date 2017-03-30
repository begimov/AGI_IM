<?php

namespace App\Policies;

use App\User;
use App\Conversation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Conversation $conversation)
    {
      return $user->isInConversation($conversation);
    }
}
