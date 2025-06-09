<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Category::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name'=>["en"=>"Electronics" , "ar"=>"الالكترونيات"],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name'=>["en"=>"Furniture" , "ar"=>"الاثاث"],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name'=>["en"=>"clothes" , "ar"=>"ملابس"],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ["en"=>'Laptops',"ar"=>"اجهزه كمبيوتر"],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ["en"=>'Mobiles',"ar"=>"موبيل"],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Home & Kitchen', 'ar' => 'المنزل والمطبخ'],
               'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg', 
            ],
            [
                'name' => ['en' => 'Beauty & Health', 'ar' => 'الجمال والصحة'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Pet Supplies', 'ar' => 'مستلزمات حيوانات'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Sports', 'ar' => 'رياضة'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Toys & Games', 'ar' => 'العاب'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Electronics Appliances', 'ar' => 'أجهزة كهربائية'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Hand Tools', 'ar' => 'أدوات حرفية'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Garden & Outdoor', 'ar' => 'الحديقة والخارج'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Sunglasses', 'ar' => 'نظارات'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
            [
                'name' => ['en' => 'Smart Watches', 'ar' => 'ساعات ذكية'],
                'status'=>1,
                'parent'=>null,
                'icon'=>'icon.jpg',
            ],
        ];
        foreach ($data as $category) {
            Category::create($category);
        }
    }
}


// // تصنيف رئيسي
// $parentCategory = Category::create(['name' => 'التصنيف الرئيسي']);

// // تصنيف فرعي داخل التصنيف الرئيسي
// $subCategory = Category::create(['name' => 'التصنيف الفرعي 1', 'parent_id' => $parentCategory->id]);

// // تصنيف فرعي آخر داخل التصنيف الفرعي الأول
// $subSubCategory = Category::create(['name' => 'التصنيف الفرعي 2', 'parent_id' => $subCategory->id]);



// // إضافة التصنيف الرئيسي "إلكترونيات"
// $electronics = Category::create(['name' => 'إلكترونيات']);

// // إضافة التصنيف الفرعي "سمارت" داخل "إلكترونيات"
// $smart = Category::create(['name' => 'سمارت', 'parent_id' => $electronics->id]);

// // إضافة تصنيفات فرعية داخل "سمارت" (مثل "لابتوب" و "فون")
// Category::create(['name' => 'لابتوب', 'parent_id' => $smart->id]);
// Category::create(['name' => 'فون', 'parent_id' => $smart->id]);