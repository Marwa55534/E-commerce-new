<?php

use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Website\ProfileController;
use Livewire\Livewire;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Website\DynamicPageController;
use App\Http\Controllers\Website\FaqController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\BrandController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\WishlistController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use Illuminate\Support\Facades\Http;
// Route::get('/', function () {
//     return view('welcome'); 
// });

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        // 'as'=>'website.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //... 
    
        //... اي روت فيها تعدد لغات
        // Route::redirect('/','/home'); 
        Route::redirect('/', '/home')->name('/');

        Route::get('/home', [HomeController::class, 'index'])->name('website.home');
        Route::get('website/page/{slug}', [DynamicPageController::class, 'showDynamicPage'])->name('website.DynamicPage');
        Route::get('website/faqs', [FaqController::class, 'showFaqPage'])->name('website.faqs.index');

        Route::prefix('website/categories')->name('website.categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'getCategories')->name('index');
            Route::get('/{slug}/products', 'getProductsByCategory')->name('products');
        });

        Route::prefix('website/brands')->name('website.brands.')->controller(BrandController::class)->group(function () {
            Route::get('/', 'getBrands')->name('index');
            Route::get('/{slug}/products', 'getProductsByBrand')->name('products');
        });
        // newArrivals , flashProducts , flashProductsTimer , ....
        Route::get('website/products/{type}', [ProductController::class, 'getProductsByType'])->name('website.products.type');

        Route::get('website/product/show/{slug}', [ProductController::class, 'showProductPage'])->name('website.products.show');
        Route::get('website/product/related-products/{slug}', [ProductController::class, 'relatedProductsBySlug'])->name('website.products.relatedProducts');

        Route::controller(RegisterController::class)->group(function () {
            Route::get('website/show/register', 'showRegistrationForm')->name('website.showRegister');
            Route::post('website/register', 'register')->name('website.register');
        });

        Route::controller(LoginController::class)->group(function () {
            Route::get('website/show/login', 'showLoginForm')->name('website.showLogin');
            Route::post('website/login', 'login')->name('website.login');
            Route::post('website/logout', 'logout')->name('website.logout');
        });



        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('website/password/email', 'showLinkRequestForm')->name('website.password.showEmail');
            Route::post('website/password/email', 'sendResetLinkEmail')->name('website.sendOtp');

        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('website/password/reset/{token}', 'showResetForm')->name('password.reset');
            Route::post('website/password/reset', 'reset')->name('password.update');
        });


        Route::group(['middleware' => 'auth:web'], function () {
            Route::controller(ProfileController::class)->group(function () {
                Route::get('website/profile', 'index')->name('website.profile.index');
            });

            // invokable
            Route::get('website/wishlist-table', WishlistController::class)->name('website.wishlist');

            Route::get('website/carts', [CartController::class, 'showCartPage'])->name('website.cart');

            Route::get('website/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('website.showCheckoutPage');
            Route::post('website/checkout', [CheckoutController::class, 'checkout'])->name('website.checkout');


        });

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });


        // Route::get('test', function () {
        //     $response = Http::withHeaders(['Authorization' => 'Bearer rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL'])
        //         ->timeout(30)
        //         ->withoutVerifying()
        //         ->send('POST', 'https://apitest.myfatoorah.com/v2/SendPayment', [
        //             'json' => [
        //                 'InvoiceValue' => 1000,
        //                 'CustomerName' => 'fname lname',
        //                 'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
        //                 'DisplayCurrencyIso' => 'EGP',
        //                 'MobileCountryCode' => '+20',
        //                 'CustomerMobile' => '01222337747',
        //                 'CustomerEmail' => 'email@example.com',
        //                 'CallBackUrl' => 'http://localhost:8000/test/callback',
        //                 'ErrorUrl' => 'http://localhost:8000/test/error', //or 'https://example.com/error.php'
        //                 'Language' => 'en', //or 'ar'
        //             ],
        //         ]);

        //     // create order && create trunsaction => auth user_id , order_id , invois
        //     // return $response->json();
        //     return redirect($response['Data']['InvoiceURL']);
        // });




    }

);

// // success
Route::get('checkout/callback',[CheckoutController::class, 'callback']);
// error
Route::get('checkout/error',[CheckoutController::class, 'error']);


//  Route::get('test/callback', function () {
//             $response = Http::withHeaders(['Authorization' => 'Bearer rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL'])
//                 ->timeout(30)
//                 ->withoutVerifying()
//                 ->acceptJson()
//                 ->send('POST', 'https://apitest.myfatoorah.com/v2/GetPaymentStatus', [
//                     'json' => [
//                         'key' => request()->paymentId,
//                         'keyType' => 'PaymentId'
//                     ],
//                 ]);
//             // change status to paid
//             // clrear cart
//             return $response;

//             // return request();
//         });

//         Route::get('test/error', function () {
//             return request();
//         });





// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// end point : https://apitest.myfatoorah.com/v2/SendPayment
// method : post
// Header : Authorization => Bearer rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL