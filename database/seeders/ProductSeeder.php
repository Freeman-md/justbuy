<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Products [10 Products for each brand]
        Brand::all()->each(function($brand) {
            $brand->products()->saveMany(Product::factory(10)->make());
        });
    }
}
