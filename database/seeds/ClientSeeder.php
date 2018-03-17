<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $tp = [0, 7, 21, 28, 14];
        for($i=0;$i<=30;$i++)
        {
            App\Client::create([
                'name' => $faker->userName,
                'tp' => $tp[array_rand($tp, 1)],
                'address' => $faker->unique()->address,
                'contact' => $faker->name,
                'phone' => $faker->unique()->phoneNumber,
                'cui' => $faker->bankAccountNumber,
                'ro' => $faker->bankAccountNumber
            ]);
        }
    }
}
