<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::statement("TRUNCATE TABLE products");

        factory(Product::class, 1000)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
