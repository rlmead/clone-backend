<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IdeaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\IdeaUser::factory()->count(50)->create();
    }
}
