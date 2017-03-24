<?php

namespace App\Transformers;

use App\User;

class UserTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(User $u)
    {
        $scope = $this->getCurrentScope()->getIdentifier();

        return [
          'id' => $u->id,
          'name' => $u->name,
          'avatar' => $u->getAvatar($scope === 'users' || $scope === 'parent.users' ? 25 : 45),
        ];
    }
}
