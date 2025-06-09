<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // DB::table('cities')->truncate();

        $cities = [
            [
                'governorate_id'=>1,
                'name'=>[
                    'ar'=>'القاهره',
                    'en'=>'Cairo',
                ],
            ],
            [
                'governorate_id'=>1,
                'name'=>[
                    'ar'=>'حلوان',
                    'en'=>'helwan',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'مصر الجديدة',
                    'en' => 'Masr El Gedida',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'الزمالك',
                    'en' => 'Zamalek',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'مدينة نصر',
                    'en' => 'Nasr City',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'شبرا',
                    'en' => 'Shubra',
                ],
            ],

            [
                'governorate_id'=>1,
                'name'=>[
                    'ar'=>'العباسية',
                    'en'=>'Al Abbassia',
                ],
            ],
            [
                'governorate_id'=>1,
                'name'=>[
                    'ar'=>'الهرم',
                    'en'=>'Al Haram',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'المطرية',
                    'en' => 'Al Marg',
                ],
            ],
            [
                'governorate_id' => 1, 
                'name' => [
                    'ar' => 'المعادي',
                    'en' => 'Maadi',
                ],
            ],

             // Cities for Giza
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'الجيزة',
                    'en'=>'Giza',
                ],
            ],
             [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'العجوزة',
                    'en'=>'El agouza',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'أكتوبر',
                    'en'=>'6th of October',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'الهرم',
                    'en'=>'Haram',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'البحوث',
                    'en'=>'Al Buhuth',
                ],
            ],
            [
                'governorate_id'=>2, 
                'name'=>[
                    'ar'=>'المنيب',
                    'en'=>'El-Munib',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'كرداسة',
                    'en'=>'Kerdasa',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'الصف',
                    'en'=>'Al Saf',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'البدرشين',
                    'en'=>'Badrashin',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'الشيخ زايد',
                    'en'=>'Sheikh Zayed',
                ],
            ],
            [
                'governorate_id'=>2,
                'name'=>[
                    'ar'=>'الوراق',
                    'en'=>'El-Warak',
                ],
            ],

                    // Cities for Alexandria
        [
            'governorate_id'=>3,
            'name'=>[
                'ar'=>'الإسكندرية',
                'en'=>'Alexandria',
            ],
        ],
      
        [
            'governorate_id'=>3,
            'name'=>[
                'ar'=>'منتزه',
                'en'=>'Montazah',
            ],
        ],
        [
            'governorate_id'=>3,
            'name'=>[
                'ar'=>'سموحة',
                'en'=>'Smouha',
            ],
        ],
        [
            'governorate_id'=>3,
            'name'=>[
                'ar'=>'محطة الرمل',
                'en'=>'Mahatat Raml',
            ],
        ],

        // Cities for Dakahlia
        [
            'governorate_id'=>4,
            'name'=>[
                'ar'=>'الدقهلية',
                'en'=>'Dakahlia',
            ],
        ],
        [
            'governorate_id'=>4,
            'name'=>[
                'ar'=>'بلقاس',
                'en'=>'Belqas',
            ],
        ],
        [
            'governorate_id'=>4,
            'name'=>[
                'ar'=>'المنصورة',
                'en'=>'Mansoura',
            ],
        ],
        [
            'governorate_id'=>4,
            'name'=>[
                'ar'=>'طلخا',
                'en'=>'Talkha',
            ],
        ],
        [
            'governorate_id'=>4,
            'name'=>[
                'ar'=>'ديروط',
                'en'=>'Dairut',
            ],
        ],

        // Cities for Sharqia
        [
            'governorate_id'=>5,
            'name'=>[
                'ar'=>'الشرقية',
                'en'=>'Sharqia',
            ],
        ],
        [
            'governorate_id'=>5,
            'name'=>[
                'ar'=>'أبو حماد',
                'en'=>'Abu Hammad',
            ],
        ],
        [
            'governorate_id'=>5,
            'name'=>[
                'ar'=>'الزقازيق',
                'en'=>'Zagazig',
            ],
        ],
        [
            'governorate_id'=>5,
            'name'=>[
                'ar'=>'بلبيس',
                'en'=>'Belbis',
            ],
        ],
        [
            'governorate_id'=>5,
            'name'=>[
                'ar'=>'مشتول السوق',
                'en'=>'Mashtoul El-Souk',
            ],
        ],

        // Cities for Qalyubia
        [
            'governorate_id'=>6,
            'name'=>[
                'ar'=>'القليوبية',
                'en'=>'Qalyubia',
            ],
        ],
        [
            'governorate_id'=>6,
            'name'=>[
                'ar'=>'بنها',
                'en'=>'Banha',
            ],
        ],
        [
            'governorate_id'=>6,
            'name'=>[
                'ar'=>'قليوب',
                'en'=>'Qalyoub',
            ],
        ],
        [
            'governorate_id'=>6,
            'name'=>[
                'ar'=>'الخانكة',
                'en'=>'Khanka',
            ],
        ],

        // Cities for Menoufia
        [
            'governorate_id'=>7,
            'name'=>[
                'ar'=>'المنوفية',
                'en'=>'Menoufia',
            ],
        ],
        [
            'governorate_id'=>7,
            'name'=>[
                'ar'=>'شبين الكوم',
                'en'=>'Shebin El Kom',
            ],
        ],
        [
            'governorate_id'=>7,
            'name'=>[
                'ar'=>'السادات',
                'en'=>'Sadat',
            ],
        ],
        [
            'governorate_id'=>7,
            'name'=>[
                'ar'=>'منوف',
                'en'=>'Menouf',
            ],
        ],

        // Cities for Gharbia
        [
            'governorate_id'=>8,
            'name'=>[
                'ar'=>'الغربية',
                'en'=>'Gharbia',
            ],
        ],
        [
            'governorate_id'=>8,
            'name'=>[
                'ar'=>'طنطا',
                'en'=>'Tanta',
            ],
        ],
        [
            'governorate_id'=>8,
            'name'=>[
                'ar'=>'المحلة الكبرى',
                'en'=>'El Mahalla El Kubra',
            ],
        ],
        [
            'governorate_id'=>8,
            'name'=>[
                'ar'=>'زفتي',
                'en'=>'Zefti',
            ],
        ],

        // Cities for Fayoum
        [
            'governorate_id'=>9,
            'name'=>[
                'ar'=>'الفيوم',
                'en'=>'Fayoum',
            ],
        ],
        [
            'governorate_id'=>9,
            'name'=>[
                'ar'=>'الفيوم الجديدة',
                'en'=>'New Fayoum',
            ],
        ],
        [
            'governorate_id'=>9,
            'name'=>[
                'ar'=>'يوسف الصديق',
                'en'=>'Youssef El Seddik',
            ],
        ],
        [
            'governorate_id'=>9,
            'name'=>[
                'ar'=>'اطسا',
                'en'=>'Atfah',
            ],
        ],

        // Cities for Beni Suef
        [
            'governorate_id'=>10,
            'name'=>[
                'ar'=>'بني سويف',
                'en'=>'Beni Suef',
            ],
        ],
        [
            'governorate_id'=>10,
            'name'=>[
                'ar'=>'إهناسيا',
                'en'=>'Ehnasia',
            ],
        ],
        [
            'governorate_id'=>10,
            'name'=>[
                'ar'=>'ببا',
                'en'=>'Beba',
            ],
        ],
        [
            'governorate_id'=>10,
            'name'=>[
                'ar'=>'الواسطي',
                'en'=>'Al-Wasta',
            ],
        ],

        // Cities for Minya
        [
            'governorate_id'=>11,
            'name'=>[
                'ar'=>'المنيا',
                'en'=>'Minya',
            ],
        ],
        [
            'governorate_id'=>11,
            'name'=>[
                'ar'=>'العدوة',
                'en'=>'Adwa',
            ],
        ],
        [
            'governorate_id'=>11,
            'name'=>[
                'ar'=>'ملوي',
                'en'=>'Mellawi',
            ],
        ],

       // Cities for Assiut
        [
            'governorate_id'=>12,
            'name'=>[
                'ar'=>'أسيوط',
                'en'=>'Assiut',
            ],
        ],
        [
            'governorate_id'=>12,
            'name'=>[
                'ar'=>'الفتح',
                'en'=>'Al-Fath',
            ],
        ],
        [
            'governorate_id'=>12,
            'name'=>[
                'ar'=>'القوصية',
                'en'=>'Qusiya',
            ],
        ],

        // Cities for Sohag
        [
            'governorate_id'=>13,
            'name'=>[
                'ar'=>'سوهاج',
                'en'=>'Sohag',
            ],
        ],
        [
            'governorate_id'=>13,
            'name'=>[
                'ar'=>'البلينا',
                'en'=>'Balina',
            ],
        ],
        [
            'governorate_id'=>13,
            'name'=>[
                'ar'=>'طهطا',
                'en'=>'Taha',
            ],
        ],
        [
            'governorate_id'=>13,
            'name'=>[
                'ar'=>'ساقلته',
                'en'=>'Saqlitah',
            ],
        ],

        // Cities for Qena
        [
            'governorate_id'=>14,
            'name'=>[
                'ar'=>'قنا',
                'en'=>'Qena',
            ],
        ],
        [
            'governorate_id'=>14,
            'name'=>[
                'ar'=>'دشنا',
                'en'=>'Dishna',
            ],
        ],
        [
            'governorate_id'=>14,
            'name'=>[
                'ar'=>'نقادة',
                'en'=>'Naqada',
            ],
        ],

        // Cities for Suez
        [
            'governorate_id'=>15,
            'name'=>[
                'ar'=>'السويس',
                'en'=>'Suez',
            ],
        ],
        [
            'governorate_id'=>15,
            'name'=>[
                'ar'=>'السويس الجديدة',
                'en'=>'Suez New',
            ],
        ],

        // Cities for Ismailia
        [
            'governorate_id'=>16,
            'name'=>[
                'ar'=>'الإسماعيلية',
                'en'=>'Ismailia',
            ],
        ],
        [
            'governorate_id'=>16,
            'name'=>[
                'ar'=>'القنطرة شرق',
                'en'=>'Qantara Sharq',
            ],
        ],
         // Cities for Damietta
         [
            'governorate_id'=>17,
            'name'=>[
                'ar'=>'دمياط',
                'en'=>'Damietta',
            ],
        ],
        [
            'governorate_id'=>17,
            'name'=>[
                'ar'=>'رأس البر',
                'en'=>'Ras Al Bar',
            ],
        ],



    // السعوديه
        //  Cities for Riyadh
         [
            'governorate_id'=>18,  // Riyadh governorate ID
            'name'=>[
                'ar'=>'الرياض',
                'en'=>'Riyadh',
            ],
        ],
        [
            'governorate_id'=>18,
            'name'=>[
                'ar'=>'الملز',
                'en'=>'Al Malaz',
            ],
        ],
        [
            'governorate_id'=>18,
            'name'=>[
                'ar'=>'النسيم',
                'en'=>'Al Naseem',
            ],
        ],
        [
            'governorate_id'=>18,
            'name'=>[
                'ar'=>'العليا',
                'en'=>'Al Olaya',
            ],
        ],

        // Cities for Jeddah
        [
            'governorate_id'=>19,  // Jeddah governorate ID
            'name'=>[
                'ar'=>'جدة',
                'en'=>'Jeddah',
            ],
        ],
        [
            'governorate_id'=>19,
            'name'=>[
                'ar'=>'البلد',
                'en'=>'Al Balad',
            ],
        ],
        [
            'governorate_id'=>19,
            'name'=>[
                'ar'=>'التحلية',
                'en'=>'Tahlia',
            ],
        ],
        [
            'governorate_id'=>19,
            'name'=>[
                'ar'=>'الستين',
                'en'=>'Al Seteen',
            ],
        ],

        // Cities for Mecca (Makkah)
        [
            'governorate_id'=>20,  // Mecca governorate ID
            'name'=>[
                'ar'=>'مكة المكرمة',
                'en'=>'Mecca',
            ],
        ],
        [
            'governorate_id'=>20,
            'name'=>[
                'ar'=>'العزيزية',
                'en'=>'Al Aziziyah',
            ],
        ],
        [
            'governorate_id'=>20,
            'name'=>[
                'ar'=>'التنعيم',
                'en'=>'Al Tanaim',
            ],
        ],
        [
            'governorate_id'=>20,
            'name'=>[
                'ar'=>'جدة القديمة',
                'en'=>'Old Jeddah',
            ],
        ],

        // Cities for Medina (Al-Madina)
        [
            'governorate_id'=>21,  // Medina governorate ID
            'name'=>[
                'ar'=>'المدينة المنورة',
                'en'=>'Medina',
            ],
        ],
        [
            'governorate_id'=>21,
            'name'=>[
                'ar'=>'البيداء',
                'en'=>'Al Bada',
            ],
        ],
        [
            'governorate_id'=>21,
            'name'=>[
                'ar'=>'المسفلة',
                'en'=>'Al Masfalah',
            ],
        ],
        [
            'governorate_id'=>21,
            'name'=>[
                'ar'=>'قبا',
                'en'=>'Quba',
            ],
        ],

           // Cities for Qassim
           [
            'governorate_id'=>22,  // Qassim governorate ID
            'name'=>[
                'ar'=>'القصيم',
                'en'=>'Qassim',
            ],
        ],
        [
            'governorate_id'=>22,
            'name'=>[
                'ar'=>'بريدة',
                'en'=>'Buraidah',
            ],
        ],
        [
            'governorate_id'=>22,
            'name'=>[
                'ar'=>'الرس',
                'en'=>'Al-Rass',
            ],
        ],
        [
            'governorate_id'=>22,
            'name'=>[
                'ar'=>'عنيزة',
                'en'=>'Unaizah',
            ],
        ],

         // Cities for Tabuk
         [
            'governorate_id'=>23,  // Tabuk governorate ID
            'name'=>[
                'ar'=>'تبوك',
                'en'=>'Tabuk',
            ],
        ],
        [
            'governorate_id'=>23,
            'name'=>[
                'ar'=>'ضباء',
                'en'=>'Duba',
            ],
        ],
        [
            'governorate_id'=>23,
            'name'=>[
                'ar'=>'أملج',
                'en'=>'Umluj',
            ],
        ],

        // Cities for Hail
        [
            'governorate_id'=>24,  // Hail governorate ID
            'name'=>[
                'ar'=>'حائل',
                'en'=>'Hail',
            ],
        ],
        [
            'governorate_id'=>24,
            'name'=>[
                'ar'=>'الغزالة',
                'en'=>'Al Ghazalah',
            ],
        ],
        [
            'governorate_id'=>24,
            'name'=>[
                'ar'=>'الشملي',
                'en'=>'Shamli',
            ],
        ],

        // Cities for Al-Jouf
        [
            'governorate_id'=>25,  // Al-Jouf governorate ID
            'name'=>[
                'ar'=>'الجوف',
                'en'=>'Al-Jouf',
            ],
        ],
        [
            'governorate_id'=>25,
            'name'=>[
                'ar'=>'سكاكا',
                'en'=>'Sakaka',
            ],
        ],
        [
            'governorate_id'=>25,
            'name'=>[
                'ar'=>'دومة الجندل',
                'en'=>'Dumat al-Jandal',
            ],
        ],

        // Cities for Jazan
        [
            'governorate_id'=>26,  // Jazan governorate ID
            'name'=>[
                'ar'=>'جازان',
                'en'=>'Jazan',
            ],
        ],
        [
            'governorate_id'=>26,
            'name'=>[
                'ar'=>'أبو عريش',
                'en'=>'Abu Arish',
            ],
        ],
        [
            'governorate_id'=>26,
            'name'=>[
                'ar'=>'صبياء',
                'en'=>'Sabiya',
            ],
        ],

          // Cities for Abu Dhabi
          [
            'governorate_id'=>27,  // Abu Dhabi governorate ID
            'name'=>[
                'ar'=>'أبوظبي',
                'en'=>'Abu Dhabi',
            ],
        ],
        [
            'governorate_id'=>27,
            'name'=>[
                'ar'=>'المصفح',
                'en'=>'Mussafah',
            ],
        ],
        [
            'governorate_id'=>27,
            'name'=>[
                'ar'=>'الشهامة',
                'en'=>'Shahama',
            ],
        ],
        [
            'governorate_id'=>27,
            'name'=>[
                'ar'=>'مدينة خليفة',
                'en'=>'Khalifa City',
            ],
        ],
        [
            'governorate_id'=>27,
            'name'=>[
                'ar'=>'الرمحة',
                'en'=>'Al Ramah',
            ],
        ],
        
        // Cities for Dubai
        [
            'governorate_id'=>28,  // Dubai governorate ID
            'name'=>[
                'ar'=>'دبي',
                'en'=>'Dubai',
            ],
        ],
        [
            'governorate_id'=>28,
            'name'=>[
                'ar'=>'البرشاء',
                'en'=>'Al Barsha',
            ],
        ],
        [
            'governorate_id'=>28,
            'name'=>[
                'ar'=>'ديرة',
                'en'=>'Deira',
            ],
        ],
        [
            'governorate_id'=>28,
            'name'=>[
                'ar'=>'الصفا',
                'en'=>'Al Safa',
            ],
        ],
        [
            'governorate_id'=>28,
            'name'=>[
                'ar'=>'النهدة',
                'en'=>'Al Nahda',
            ],
        ],
        
        // Cities for Sharjah
        [
            'governorate_id'=>29,  // Sharjah governorate ID
            'name'=>[
                'ar'=>'الشارقة',
                'en'=>'Sharjah',
            ],
        ],
        [
            'governorate_id'=>29,
            'name'=>[
                'ar'=>'الذيد',
                'en'=>'Al Dhaid',
            ],
        ],
        [
            'governorate_id'=>29,
            'name'=>[
                'ar'=>'خورفكان',
                'en'=>'Khor Fakkan',
            ],
        ],
        [
            'governorate_id'=>29,
            'name'=>[
                'ar'=>'المدام',
                'en'=>'Al Madam',
            ],
        ],
        [
            'governorate_id'=>29,
            'name'=>[
                'ar'=>'المليحة',
                'en'=>'Mleiha',
            ],
        ],

        // Cities for Ras Al Khaimah
        [
            'governorate_id'=>30,  // Ras Al Khaimah governorate ID
            'name'=>[
                'ar'=>'رأس الخيمة',
                'en'=>'Ras Al Khaimah',
            ],
        ],
        [
            'governorate_id'=>30,
            'name'=>[
                'ar'=>'الجازة',
                'en'=>'Al Jazirah',
            ],
        ],
        [
            'governorate_id'=>30,
            'name'=>[
                'ar'=>'الرمس',
                'en'=>'Al Rams',
            ],
        ],
        [
            'governorate_id'=>30,
            'name'=>[
                'ar'=>'شعم',
                'en'=>'Shaam',
            ],
        ],
        [
            'governorate_id'=>30,
            'name'=>[
                'ar'=>'الحمراء',
                'en'=>'Al Hamra',
            ],
        ],
    ];
        
        foreach ($cities as $city) {
            City::create($city);
        }
        
    }
}
