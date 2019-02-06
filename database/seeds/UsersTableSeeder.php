<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Warey Games',
            'email' => 'adminer@wareygames.com',
            'password' => bcrypt('hyt2019'),
            'remember_token' => str_random(10),
        ]);
    }
}
