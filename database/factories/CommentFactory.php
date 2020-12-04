<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'idea_id' => DB::table('ideas')->inRandomOrder()->first()->id,
            'user_id' => DB::table('users')->inRandomOrder()->first()->id,
            'text' => $this->faker->paragraph
        ];
    }
}
