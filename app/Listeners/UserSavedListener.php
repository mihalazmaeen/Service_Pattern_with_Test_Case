<?php

namespace App\Listeners;

use App\Events\UserSavedEvent;
use App\Models\UserAddress;

class UserSavedListener
{
    public function handle(UserSavedEvent $event)
    {
        $user = $event->user;

        // Check if there are address data in the event
        if ($event->addressData) {
            foreach ($event->addressData as $addressData) {
                 
                // Create a new address for the user
                $address = new UserAddress();
                $address->fill($addressData);
          

                // Associate the address with the user
                $user->addresses()->save($address);
            }
        }
    }
}
