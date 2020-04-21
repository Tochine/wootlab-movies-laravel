<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

 
        // Hashing the password 
        $password = Hash::make('toptal');

        User::create([
            'name' => 'WootLab',
            'email' => 'wootlab@wootlab.cm',
            'password' => $password,
        ]);

        // Generate users
            for ($i = 0; $i < 1; $i++) {
                User::create([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => $password,
                ]);
            }
    }
}
