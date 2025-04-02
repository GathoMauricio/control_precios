<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDotech;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $dots = UserDotech::all();
        foreach ($dots as $dot) {
            User::create([
                'name' => $dot->name . ' ' . $dot->middle_name,
                'email' => $dot->email,
                'password' => $dot->password,
            ]);
        }
    }
}
