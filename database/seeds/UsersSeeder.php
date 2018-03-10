<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i <= 15; $i++)
        {
            App\User::create([
//                'username' => $faker->userName,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123456')
            ]);
        }
    }
}
