<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Setting;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Models\Page;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('dashboard.*',function($view){
            // check
            if(! Cache::has('categories_count')){
                $categories_count = Category::count();

                // نخزن
                Cache::remember('categories_count',3600,function() use($categories_count){
                    return $categories_count;
                });
            }  

            // check
            if(! Cache::has('brands_count')){
                $brands_count = Brand::count();

                // نخزن
                Cache::remember('brands_count',3600,function() use($brands_count){
                    return $brands_count;
                });
            }

            // check
            if(! Cache::has('admins_count')){
                $admins_count = Admin::count(); 

                // نخزن
                Cache::remember('admins_count',3600,function() use($admins_count){
                    return $admins_count;
                });
            }

            if(! Cache::has('coupons_count')){
                $coupons_count = Coupon::count();

                Cache::remember('coupons_count',3600,function() use($coupons_count){
                    return $coupons_count;
                });
            }

            if(! Cache::has('faqs_count')){
                $faqs_count = Faq::count();

                Cache::remember('faqs_count',3600,function()use($faqs_count){
                    return $faqs_count;
                });
            }

            if(! Cache::has('contacts_count')){
                // $contacts_count = Contact::count();

                Cache::remember('contacts_count', now()->addMinutes(60),function (){
                    return Contact::where('is_read',0)->count();
                });
            }

            // نجيب الداتا
            $categories_count = Cache::get('categories_count');
            $brands_count = Cache::get('brands_count');
            $admins_count = Cache::get('admins_count');
            $coupons_count = Cache::get('coupons_count');
            $faqs_count = Cache::get('faqs_count');
            $contacts_count = Cache::get('contacts_count');


            // share data in views
            view()->share([
                'categories_count'=>$categories_count,
                'brands_count'=>$brands_count,
                'admins_count'=>$admins_count,
                'coupons_count'=>$coupons_count,
                'faqs_count'=>$faqs_count,
                'contacts_count'=>$contacts_count,

            ]);
        });

        view()->composer('website.*',function($view){
            $pages = Page::select('slug','title','id')->get();

            $categories_children = $this->getCategoriesChildrenNavbar();
            $categories = $this->getCategories();

            view()->share([
                'pages' => $pages,
                'categories_children' => $categories_children,
                'categories' => $categories,

            ]);
        });

        // get Setting And Share
        $setting = $this->firstOrCreateSetting();

        view()->share([
            'setting' => $setting,
        ]);
    }
    public function firstOrCreateSetting()
    {
        // بتجيب اول صف 
        $getSetting = Setting::firstOr(function () {
            // لو مش موجود هتبدا تنفذ 
            return Setting::create([
                'site_name' => [
                    'ar' => 'متجر الكتروني',
                    'en' => 'E-Commerce',
                ],
                'site_desc' => [
                    'en' => 'This is E-Commerce website',
                    'ar' => 'هذا موقع متجر الكتروني ',
                ],
                'address' => [
                    'en' => 'Egypt , Alex , Mandara',
                    'ar' => 'مصر , الاسكندريه ,  المندره',
                ],
                'phone' => '01222220000',
                'email' => 'e-commerce@gmail.com',
                'email_support' => 'e-commerceSupport@gmail.com',

                // socail
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://www.twitter.com/',
                'youtupe' => 'https://www.youtube.com/',

                'logo' => 'logo.png',
                'favicon' => 'logo.png', 
                'site_copyright' => '©2025 Your E-commerce Name. All rights reserved.',

                'meta_description' => [
                    'en' => '23 of PARAGE is equality of condition, blood, or dignity; specifically',
                    'ar' => '23 of PARAGE is equality of condition, blood, or dignity; specifically ',
                ],
                'promotion_video_url' => 'https://www.youtube.com/embed/SsE5U7ta9Lw?rel=0&amp;controls=0&amp;showinfo=0',

            ]);
        });
        return $getSetting;
    }

    public function getCategories(){
        $categories = Category::active()->select('id','name','slug','icon')->get();
        return $categories;
    }

    public function getCategoriesChildrenNavbar(){
        // children_count
        $categories = Category::withCount('children')->having('children_count' , '>' , 2)
            ->active()->where('parent',null)->limit(4)->get();

        foreach ($categories as $category) {
            $category->children = $category->children()->limit(4)->get();
        }
        return $categories;
    }

}
