<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Category 1',
                'slug' => 'category-1',
                'image' => 'category1.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Category 2',
                'slug' => 'category-2',
                'image' => 'category2.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Category 3',
                'slug' => 'category-3',
                'image' => 'category3.jpg',
                'status' => 1,
            ],
        ]);
    }
}
