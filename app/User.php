<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conversations()
    {
        // TODO: belongsTo(Conversation::class) ??? or belongsToMany?
        return $this->belongsTo('Conversation')->whereNull('parent_id')->orderBy('last_reply', 'desc');
    }

    public function isInConversation(Conversation $c)
    {
        return $this->conversations->contains($c);
    }

    public function getAvatar($size = 45)
    {
        return "https://www.gravatar.com/avatar/{md5($this->email)}?s={$size}&d=mm";
    }
    
}
