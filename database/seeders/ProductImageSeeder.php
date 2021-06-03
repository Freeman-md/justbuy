<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Product Images [Note: Requires Internet Connection]
        try {
            $data = getImages();
            $index = 0;
            Product::all()->each(function($product) use ($data, &$index) {
                // Starting from 0
                $product->image()->update([
                'small' => $data['photos'][$index]['src']['small'],
                'medium' => $data['photos'][$index]['src']['medium'],
                ]);
                $index++;
            });
        } catch (\Throwable $th) {
            return;
        }
    }
}
