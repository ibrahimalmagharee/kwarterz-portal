<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'=>'أسلوب الحياة',
                'type' =>'activity'
             ],
            [
               'name'=>'السفر',
               'type' =>'activity'
            ],
            [
               'name'=>'تصميم',
               'type' =>'activity'
            ]
            
        ];
        foreach ($categories as $key => $category) {
            $social = Category::create($category);
        }
    }
}
