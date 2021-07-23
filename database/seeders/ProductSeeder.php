<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seeds database with Products (and their brands)
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()
            ->count(100)
            ->hasProducts(5)
            ->create();
    }
}
