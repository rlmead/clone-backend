<?php

namespace Database\Factories;

use App\Models\IdeaUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class IdeaUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IdeaUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idea_id' => DB::table('ideas')->inRandomOrder()->first()->id,
            'user_id' => DB::table('users')->inRandomOrder()->first()->id,
            'user_role' => (rand(0,1) ? "creator" : "collaborator")
        ];
    }
}
