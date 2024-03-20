<?php 
namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition()
    {
        return [
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            // Add other attributes as needed
        ];
    }
}
