<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // DB::table('countries')->truncate();

        $countries = [
            [
                'id'=>1,
                'phone_code'=>'20',
                'name'=>['en'=>'Egypt' , 'ar'=>'مصر'],
                'flag_code'=>'eg',
            ],
            [
                'id'=>2,
                'phone_code'=>'966',
                'name'=>['en'=>'Saudi Arabia' , 'ar'=>'السعودية'],
                'flag_code'=>'sd'
            ],
            [
                'id'=>3,
                'phone_code'=>'971',
                'name'=>['en'=>'United Arab Emirates' , 'ar'=>'الإمارات'],
                'flag_code'=>'ae',
            ],
        ];
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
