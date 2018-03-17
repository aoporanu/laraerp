<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createOrder = new \App\Permission();
        $createOrder->name = 'create-order';
        $createOrder->display_name = 'Create order';
        $createOrder->description = 'Create orders';
        $createOrder->save();
    }
}
