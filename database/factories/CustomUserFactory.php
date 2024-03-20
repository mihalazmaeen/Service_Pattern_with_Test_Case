<?php 
namespace Database\Factories;

use App\Models\CustomUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomUserFactory extends Factory
{
    protected $model = CustomUser::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password', // You may use any default value you want
        ];
    }
}
