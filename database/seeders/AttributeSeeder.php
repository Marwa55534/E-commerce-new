<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        Attribute::truncate();
        AttributeValue::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        

        $size_attribute = Attribute::create([
            'name' =>[
                'ar'=>'المقاس',
                'en'=>'Size',

            ],
        ]);

        $size_attribute->attributeValues()->createMany([
            [
                'value'=>[
                    'ar'=>'صغير',
                    'en'=>'Small',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'متوسط',
                    'en'=>'Medium',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'كبير',
                    'en'=>'Large',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'كبير جدا',
                    'en'=>'X Large',
                ],
            ],
        ]);

        $color_attribute = Attribute::create([
            'name'=>[
                'ar'=>'اللون',
                'en'=>'color',
            ],
        ]);
        $color_attribute->attributeValues()->createMany([
            [
                'value'=>[
                    'ar'=>'احمر',
                    'en'=>'Red',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'اف وايت',
                    'en'=>'Off white',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'اسود',
                    'en'=>'black',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'بني',
                    'en'=>'brown',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'بيج',
                    'en'=>'beige',
                ],
            ],
            [
                'value'=>[
                    'ar'=>'رمادي',
                    'en'=>'gray',
                ],
            ],
        ]);
    }
}
