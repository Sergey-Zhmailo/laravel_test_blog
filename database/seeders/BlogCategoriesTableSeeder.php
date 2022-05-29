<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categoryName = 'No category';

        $categories[] = [
            'title' => $categoryName,
            'slug' => STR::slug($categoryName),
            'parent_id' => 0,
        ];

        for ($i = 2; $i <= 11; $i++) {
            $categoryName = 'Category #' . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $categoryName,
                'slug' => STR::slug($categoryName),
                'parent_id' => $parentId,
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
