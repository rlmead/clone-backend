<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Str::random(10),
            'image_url' => null,
            'location_id' => null,
            'pronouns' => 'they/them',
            'bio' => $this->faker->paragraph,
            'enabled' => (rand(0,4) ? 1 : 0),
            'last_logged_in' => $this->faker->dateTime(),
            'email_verified_at' => (rand(0,1) ? null : $this->faker->dateTime())
        ];
    }
}
