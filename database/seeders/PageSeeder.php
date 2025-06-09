<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title'=>[
                'ar'=>'سياسة الخصوصية',
                'en'=>'Privacy Policy',
            ],
            'content'=>[
                'ar'=>'عادةً ما تتضمن الشروط والأحكام وصفًا موجزًا ​​لسياسة الخصوصية الخاصة بك أو بيانًا يُفيد بأن استخدام الموقع يعني موافقتك على طريقة تعاملك مع بياناتك الشخصية ومعالجتها. وقد صمد هذا الموقع ليس فقط لخمسة قرون، بل أيضًا مع القفزة النوعية الأولى نحو الطباعة الإلكترونية، وظل دون تغيير جوهري. لم يشتهر في ستينيات القرن الماضي مع إصدار أوراق',
                'en'=>'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
            ],
            'slug'=>'privacy-policy',
        ]);
        Page::create([
            'title'=>[
                'ar'=>'الشروط والمصطلحات',
                'en'=>'Terms and Condition',
            ],
            'content'=>[
                'ar'=>'عادةً ما تتضمن الشروط والأحكام وصفًا موجزًا ​​لسياسة الخصوصية الخاصة بك أو بيانًا يُفيد بأن استخدام الموقع يعني موافقتك على طريقة تعاملك مع بياناتك الشخصية ومعالجتها. وقد صمد هذا الموقع ليس فقط لخمسة قرون، بل أيضًا مع القفزة النوعية الأولى نحو الطباعة الإلكترونية، وظل دون تغيير جوهري. لم يشتهر في ستينيات القرن الماضي مع إصدار أوراق',
                'en'=>'Terms and conditions typically have a short description of your privacy policy or a statement declaring that using the site means expressing consent to the way you handle and process personal data. It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.',
            ],
            'slug'=>'terms-condition',
        ]);
    }
}
