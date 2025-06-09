<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\OrderShippingRequest;
use App\Services\Website\OrderService;
use Illuminate\Support\Facades\Session;
use App\Services\Website\MyFatoorahService;
use App\Notifications\CreateOrderNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class CheckoutController extends Controller
{
    protected $orderService;
    protected $myFatoorahService;

    public function __construct(OrderService $orderService, MyFatoorahService $myFatoorahService)
    {
        $this->orderService = $orderService;
        $this->myFatoorahService = $myFatoorahService;

    }

    public function showCheckoutPage()
    {
        return view('website.checkout');
    }

    public function checkout(OrderShippingRequest $request)
    {
        // return $request;
        $shipping = $request->validated();

        $invoiceValue = $this->orderService->getInvoiceValue($shipping);
        if ($invoiceValue < 1 || $invoiceValue == null) {
            return redirect()->back()->with('error', 'cart is empty');
        }

        //   الاند بوينتس اللي انا هبدا ان انا اعمل لها كول
        // عشان اكريت فاتوره مع مين مع بوابه الدفع ماي فاتوره 
        // عندهم بتكارت انفويس فالاند بوينت دي رجعت في الريسبونس انفويس اي دي وانفويس يو ار
        $data = [
            'CustomerName' => $shipping['first_name'] . ' ' . $shipping['last_name'],
            'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
            'InvoiceValue' => $invoiceValue, // الاجمالي الفاتوره
            'DisplayCurrencyIso' => 'EGP',
            'CustomerEmail' => $shipping['user_email'],
            'CallBackUrl' => 'http://localhost:8000/checkout/callback',
            // 'CallBackUrl' => env('fatoorah_callback_url'),
            'ErrorUrl' => 'http://localhost:8000/checkout/error',
            // 'ErrorUrl' => env('fatoorah_error_url'), //or 'https://example.com/error.php'
            'Language' => app()->getLocale() == 'ar' ? 'ar' : 'en', //or 'ar'
        ];

        $data = $this->myFatoorahService->checkout($data);

        // والله الداتا فيها كي اسمه داتا داخل الداتا ده في كي اسمه انفويس يو ار ال
        if ($url = $data['Data']['InvoiceURL']) {


            // store order
            $createOrder = $this->orderService->createOrder($shipping);
            // $createOrder = $this->orderService->createOrder($request->all()); 

            if (!$createOrder) {
                Session::flash('error', __('dashboard.error_msg'));
                return redirect()->route('website.showCheckoutPage');
            }

            // store trunsa
            $createTransaction = $this->orderService->createTransaction($data, $createOrder->id);
            if (!$createTransaction) {
                Session::flash('error', __('dashboard.error_msg'));
                return redirect()->back();
            }
            // بعمل ريدايركت على مين؟ على اليو ار ال اللي انا هروح ادفع عليه
            return redirect($url);

        } else {
            Session::flash('error', 'something went wrong');
        }

        Session::flash('success', 'order crated successfully');
        return redirect()->back();
    }



    public function callback(Request $request)
    {
        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'PaymentId';

        $response = $this->myFatoorahService->getPaymentStatus($data);

        // change order status
        $user_id = Transaction::where('transaction_id', $response['Data']['InvoiceId'])->pluck('user_id');
        $order_id = Transaction::where('transaction_id', $response['Data']['InvoiceId'])->pluck('order_id');


        if ($response['Data']['InvoiceStatus'] == 'Paid') {

            Order::where('id', $order_id)
                ->where('user_id', $user_id)
                ->update(['status' => 'paid']);

            // $this->orderService->clearUserCart(auth('web')->user()->cart);
            $user = auth('web')->user();
            if ($user && $user->cart) {
                $this->orderService->clearUserCart($user->cart);
            }

            // send notification
            $order = Order::where('id', $order_id)->where('user_id', $user_id)->first();
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new CreateOrderNotification($order));
            }

            Session::flash('success', 'تم الدفع بنجاح راقب حاله الاوردر');
            return redirect()->route('website.showCheckoutPage');

        }
        Session::flash('error', 'فشلت عمليه الدفع');
        return redirect()->route('website.showCheckoutPage');

    }

    public function error()
    {
        Session::flash('error', 'payment faild');
        return redirect()->route('website.showCheckoutPage');
    }

}
