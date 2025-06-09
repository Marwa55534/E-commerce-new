<?php

namespace Database\Seeders;

use App\Models\ShippingGovernorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Governorate;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Governorate::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // DB::table('governorates')->truncate();

        $governorates = [
            // مصر
            array('name' => ['en'=>'Cairo' , 'ar'=>'القاهرة'] ,'country_id'=>1),
            array('name' => ['en'=>'Giza', 'ar'=>'الجيزة'], 'country_id'=>1),
            array('name' => ['en'=>'Alexandria' , 'ar'=>'الإسكندرية'] ,'country_id'=>1),
            array('name' => ['en'=>'Dakahlia', 'ar'=>'الدقهلية'], 'country_id'=>1),
            array('name' => ['en'=>'Sharqia', 'ar'=>'الشرقية'], 'country_id'=>1),
            array('name' => ['en'=>'Qalyubia', 'ar'=>'القليوبية'], 'country_id'=>1),
            array('name' => ['en'=>'Menoufia', 'ar'=>'المنوفية'], 'country_id'=>1),
            array('name' => ['en'=>'Gharbia', 'ar'=>'الغربية'], 'country_id'=>1),
            array('name' => ['en'=>'Fayoum', 'ar'=>'الفيوم'], 'country_id'=>1),
            array('name' => ['en'=>'Beni Suef', 'ar'=>'بني سويف'], 'country_id'=>1),
            array('name' => ['en'=>'Minya', 'ar'=>'المنيا'], 'country_id'=>1),
            array('name' => ['en'=>'Asyut', 'ar'=>'أسيوط'], 'country_id'=>1),
            array('name' => ['en'=>'Sohag', 'ar'=>'سوهاج'], 'country_id'=>1),
            array('name' => ['en'=>'Qena', 'ar'=>'قنا'], 'country_id'=>1),
            array('name' => ['en'=>'Suez', 'ar'=>'السويس'], 'country_id'=>1),
            array('name' => ['en'=>'Ismailia', 'ar'=>'الإسماعيلية'], 'country_id'=>1),
            array('name' => ['en'=>'Damietta', 'ar'=>'دمياط'], 'country_id'=>1),

            // السعوديه
            array('name' => ['en'=>'Riyadh', 'ar'=>'الرياض'], 'country_id'=>2),
            array('name' => ['en'=>'Jeddah', 'ar'=>'جدة'], 'country_id'=>2),
            array('name' => ['en'=>'Mecca', 'ar'=>'مكة المكرمة'], 'country_id'=>2),
            array('name' => ['en'=>'Medina', 'ar'=>'المدينة المنورة'], 'country_id'=>2),
            array('name' => ['en'=>'Qassim', 'ar'=>'القصيم'], 'country_id'=>2),
            array('name' => ['en'=>'Tabuk', 'ar'=>'تبوك'], 'country_id'=>2),
            array('name' => ['en'=>'Hail', 'ar'=>'حائل'], 'country_id'=>2),
            array('name' => ['en'=>'Al-Jouf', 'ar'=>'الجوف'], 'country_id'=>2),
            array('name' => ['en'=>'Jazan', 'ar'=>'جازان'], 'country_id'=>2),

            // الإمارات
            array('name' => ['en'=>'Abu Dhabi', 'ar'=>'ابوظبي'], 'country_id'=>3),
            array('name' => ['en'=>'Dubai', 'ar'=>'دبي'], 'country_id'=>3),
            array('name' => ['en'=>'Sharjah', 'ar'=>'الشارقة'], 'country_id'=>3),
            array('name' => ['en'=>'Ras Al Khaimah', 'ar'=>'رأس الخيمة'], 'country_id'=>3),
        ];
        foreach ($governorates as $governorate) {
            $governorate = Governorate::create($governorate);

            ShippingGovernorate::create([
                'governorate_id'=>$governorate->id,
                'price'=>'100',

            ]);
        }
    }
}
