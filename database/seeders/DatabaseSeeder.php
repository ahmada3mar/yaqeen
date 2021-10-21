<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email' => 'ahmada3mar@gmail.com',
            'name' => 'احمد عبد السميع',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123456789'),
            'branch_id' =>1,
            'role' =>'exporter',
            'username' => 'ahmada3mar'
        ]);
    }
}
