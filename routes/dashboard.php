<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Password\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Password\ResetPasswordController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\WorldController;
use App\Http\Controllers\Dashboard\CategoryController; 
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\ProductController;
use Livewire\Livewire;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\FaqQuestionController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Middleware\MarkNotificationAsRead;

// Route::get('/', function () { 
//     return view('welcome'); 
// });
 
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(), 
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //... 

        //... اي روت فيها تعدد لغات

    Route::controller(ForgetPasswordController::class)->group(function (){
        Route::get('dashboard/show/email','showEmailForm')->name('dashboard.email');
        Route::post('dashboard/email','sendOtp')->name('dashboard.password.email.post');

        Route::get('dashboard/verify/{email}','showOtpForm')->name('dashboard.otp');
        Route::post('dashboard/verifyOtp','verifyOtp')->name('dashboard.password.verifyOtp.post');

    }); 

    Route::controller(ResetPasswordController::class)->group(function (){
        Route::get('dashboard/reset/{email}','showResetForm')->name('dashboard.reset');
        Route::post('dashboard/reset','resetPassword')->name('dashboard.password.reset.post');

    });

    Route::controller(AuthController::class)->group(function (){
        Route::get('dashboard/show/login','showLoginForm')->name('dashboard.login');
        Route::post('dashboard/login','login')->name('dashboard.login.post');

        // auth:admin
        Route::post('dashboard/logout','logout')->name('dashboard.logout');
    });

    Route::group(['middleware'=>"auth:admin"],function(){
        
        Route::get('dashboard/welcome',[WelcomeController::class , "index"])->name('dashboard.welcome');
        
        Route::group(['middleware' => 'can:roles'] , function(){
            Route::resource('dashboard/roles',RoleController::class );

        });

        Route::group(['middleware' => 'can:admins'] , function(){
            Route::resource('dashboard/admins',AdminController::class );

            Route::post('dashboard/admins/ajax_search',[AdminController::class, "searchByAjax" ])->name('admins.searchByAjax');

            Route::get('dashboard/admins/status/{id}',[AdminController::class,  "changeStatus" ])->name('admins.changeStatus');

        });

        Route::group(['middleware' => 'can:global_shipping'] , function(){
            Route::controller(WorldController::class)->group(function () {
                Route::get('dashboard/countries',                              'getCountries')->name('dashboard.countries.index');
                Route::get('dashboard/governorates/{id}',     'getGovernorates')->name('dashboard.governorates.index');
                Route::get('dashboard/change-status/{country_id}',    'changeStatus')->name('dashboard.countries.changeStatus');
             
                // governorate
                Route::get('dashboard/changeStatus/{governorate_id}',       'changeGovStatus')->name('dashboard.governorate.status');
                Route::put('dashboard/shipping-price',               'changeShippingPrice')->name('dashboard.governorate.shipping-price');
            
            });
        });


        // CategoryController
        Route::group(['middleware' => 'can:categories'] , function(){
            Route::resource('dashboard/categories',CategoryController::class )->except('show');
            Route::get('categories/getAll',[CategoryController::class , 'getAll'])->name('dashboard.categories.all');        
        });

        Route::group(['middleware' => 'can:barands'] , function(){
            Route::resource('dashboard/brands',BrandController::class )->except('show');
            Route::get('brands/getAll',[BrandController::class , 'getAll'])->name('dashboard.brands.all');
        });

        Route::group(['middleware' => 'can:coupons'] , function(){
            Route::resource('dashboard/coupons',CouponController::class )->except('show');
            Route::get('coupons/getAll',[CouponController::class , 'getAll'])->name('dashboard.coupons.all');
        }); 

        Route::group(['middleware' => 'can:faqs'] , function(){
            Route::resource('dashboard/faqs',FaqController::class );
            Route::get('faqs/getAll',[FaqController::class , 'getAll'])->name('dashboard.faqs.all');
        }); 

        Route::group(['middleware' => 'can:faqs'] , function(){
            Route::get('dashboard/faqs-question/index',[FaqQuestionController::class , 'index'])->name('dashboard.faqs-question.index');
            Route::get('dashboard/faqs-question/getAll',[FaqQuestionController::class , 'getAll'])->name('dashboard.faqs-question.all');
            Route::delete('dashboard/faqs-question/{id}',[FaqQuestionController::class , 'delete'])->name('dashboard.faqs-question.delete');
        }); 


        Route::group(['middleware' => 'can:settings'] , function(){
            Route::get('dashboard/settings',[SettingController::class,'index'])->name('dashboard.settings.index');
            Route::put('dashboard/setting/{id}',[SettingController::class , 'update'])->name('dashboard.setting.update');
        });

        Route::group(['middleware' => 'can:attributes'] , function(){
            Route::resource('dashboard/attributes',AttributeController::class );
            Route::get('attributes/getAll',[AttributeController::class , 'getAll'])->name('dashboard.attributes.all');
        });

        Route::group(['middleware' => 'can:products'] , function(){
            Route::resource('dashboard/products',ProductController::class );
            Route::get('products/getAll',[ProductController::class , 'getAll'])->name('dashboard.products.all');
            Route::post('dashboard/products/status' , [ProductController::class, 'changeStatus'])->name('dashboard.products.status');

            //Variants
            // Route::get('products/variants/{variant_id}' , [ProductController::class, 'deleteVariant'])->name('products.variants.delete');
            Route::delete('products/variants/{variant_id}', [ProductController::class, 'deleteVariant'])->name('products.variants.delete');
        });

        Route::group(['middleware' => 'can:users'] , function(){
            Route::resource('dashboard/users',UserController::class );
            Route::get('users/getAll',[UserController::class , 'getAll'])->name('dashboard.users.all');
            Route::post('dashboard/users/status' , [UserController::class, 'changeStatus'])->name('dashboard.users.status');
        });

        Route::group(['middleware' => 'can:contacts'] , function(){
            Route::get('dashboard/contacts/index',[ContactController::class , 'index'])->name('dashboard.contacts.index')->middleware(MarkNotificationAsRead::class);
            // Route::get('contacts-reply', [ContactController::class, 'getAll'])->name('users.all');
        });

        Route::group(['middleware' => 'can:sliders'] , function(){
            Route::get('dashboard/sliders/index',[SliderController::class , 'index'])->name('dashboard.sliders.index');
            Route::get('dashboard/sliders/getAll',[SliderController::class , 'getAll'])->name('dashboard.sliders.all');
            Route::post('dashboard/slider/store',[SliderController::class , 'store'])->name('dashboard.slider.store');
            Route::delete('dashboard/slider/destroy/{id}',[SliderController::class , 'destroy'])->name('dashboard.slider.destroy');
        });

        Route::group(['middleware' => 'can:pages'] , function(){
            Route::resource('dashboard/pages',PageController::class );
            Route::get('pages/getAll',[PageController::class , 'getAll'])->name('dashboard.pages.all'); 
            Route::post('dashboard/pages/{id}/delete-image', [PageController::class, 'deleteImage'])->name('pages.delete-image');
       
        });

         Route::group(['middleware' => 'can:orders'] , function(){
            Route::get('dashboard/orders/index',[OrderController::class , 'index'])->name('dashboard.orders.index'); 
            Route::get('dashboard/orders/getAll',[OrderController::class , 'getAll'])->name('dashboard.orders.all'); 
            Route::get('dashboard/order/show/{id}',[OrderController::class , 'show'])->name('dashboard.order.show')->middleware(MarkNotificationAsRead::class); 
            Route::delete('dashboard/order/destroy/{id}',[OrderController::class , 'destroy'])->name('dashboard.order.destroy'); 

            Route::get('dashboard/makeDelivered/{id}', [OrderController::class, 'makeDelivered'])->name('dashboard.orders.makeDelivered');
       
        });
         
    });  
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    }); 

});

// Route::get('test',function(){
//     return view('dashboard.auth.password.confirm');
// });
