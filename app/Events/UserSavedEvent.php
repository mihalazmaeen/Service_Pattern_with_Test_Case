<?php

namespace App\Events;

use App\Models\CustomUser;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSavedEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $addressData;

    public function __construct(CustomUser $user, array $addressData)
    {
        $this->user = $user;
        $this->addressData = $addressData;
    }
}
