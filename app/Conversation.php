<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    private $dates = ['last_reply'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function users()
    {
        return $this->belongsToMany('User');
    }

    public function usersExceptCurrentlyAuthenticated()
    {
        // TODO: $this->users()? & Auth::user()->id
        return $this->user()->where('user_id', '!=', Auth::id());
    }

    public function replies()
    {
        return $this->hasMany('Conversation', 'parent_id')->latestFirst();
    }

    public function parentConversation()
    {
        return $this->belongsTo('Conversation', 'parent_id');
    }

    public function touchLastReply()
    {
        $this->last_reply = \Carbon\Carbon::now();
        $this->save();
    }

    public function isReply()
    {
        return $this->parent_id != null;
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
