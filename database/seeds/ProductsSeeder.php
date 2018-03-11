<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
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
            App\Product::create([
                'sku' => $faker->unique()->bankAccountNumber,
                'name' => $faker->unique()->firstName,
                'price' => rand(0.34, 100.25),
                'category_id' => rand(1,15),
                'supplier_id' => rand(1,15),
            ]);
        }
    }
}
