<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoryRecords = [
            ['id' =>1, 
            'parent_id' => 0,
            'name' => 'Clothing',
            'image' => '',
            'discount' => 0,
            'description' => '',
            'url' => 'clothing',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
            ['id' =>2,
            'parent_id' => 1,
            'name' => 'Fashion',
            'image' => '',
            'discount' => 0,
            'description' => '',
            'url' => 'fashion',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
            ['id' =>3,
            'parent_id' => 0,
            'name' => 'Home & Furniture',
            'image' => '',
            'discount' => 0,            
            'description' => '',
            'url' => 'home-and-furniture',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
            ['id' =>4,
            'parent_id' => 1,
            'name' => 'Sports',
            'image' => '',
            'discount' => 0,
            'description' => '',
            'url' => 'sports',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
            ['id' =>5,
            'parent_id' => 0,
            'name' => 'Books',
            'image' => '',
            'discount' => 0,
            'description' => '',
            'url' => 'books',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
            ['id' =>6,
            'parent_id' => 0,
            'name' => 'Beauty & Health',
            'image' => '',
            'discount' => 0,
            'description' => '',
            'url' => 'beauty-and-health',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keyword' => '',
            'status' => 1,
            ],
        ];
        Category::insert($categoryRecords);
    }
}
