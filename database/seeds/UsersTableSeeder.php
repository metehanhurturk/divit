<?php

use Illuminate\Database\Seeder;
use Divit\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master = User::create(
            [
                'name' => 'Metehan',
                'email' => 'metehan@divit.com',
                'password' => bcrypt('secret'),
            ]
        );
    }
}
