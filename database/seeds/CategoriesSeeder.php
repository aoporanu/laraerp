<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<=15;$i++) {
            App\Category::create([
                'sku' => $faker->unique()->bankAccountNumber,
                'name' => $faker->unique()->firstName
            ]);
        }
    }
}
