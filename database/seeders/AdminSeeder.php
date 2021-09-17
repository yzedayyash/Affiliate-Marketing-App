<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     \App\Models\User::factory()->create(
        [
        'email' => 'admin@admin.com' ,

        'is_admin' => 1 ]
    );

    }
}
