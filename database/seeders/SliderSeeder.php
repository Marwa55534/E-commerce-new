<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <3 ; $i++) { 
            Slider::create([
                'file_name'=>'slider'.$i.'.jpg',
                'note'=>[
                    'ar'=>'مجموعة أزياء صيفية بخصم يصل إلى 70% ',
                    'en'=>'Fashion Collection Summer Sale Up To 70% OFF',
                ],
            ]);
        }
    }
}
