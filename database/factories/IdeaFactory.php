<?php

namespace Database\Factories;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Idea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'status' => (rand(0,4) ? "open" : "closed"),
            'image_url' => null,
            'ref_location_id' => rand(0,10),
            'description' => $this->faker->paragraph
        ];
    }
}
