<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\OrderService;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    { 
        return view('dashboard.orders.index');
    }

    public function getAll(Request $request)
    {
        return $this->orderService->getAll($request);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderWithItemsById($id);
        if(!$order){
            Session::flash('error','Order Not found');
            return redirect()->back();
        }

        return view('dashboard.orders.show',compact('order'));
    }

    public function makeDelivered($id){
        $order = $this->orderService->markeOrderAsDelivered($id);
        if(!$order){
            Session::flash('error','Order can Not Delivered');
            return redirect()->back();
        }
        Session::flash('success','Order Mark Delivered Successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = $this->orderService->destroy($id);

        if (!request()->expectsJson()) {
            if (!$order) {
                Session::flash('error','Order Can Not Deleted');
                return redirect()->back();
            }
            Session::flash('success','Order Deleted Successfully');
            return redirect()->back(); 
        }

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order Can Not Deleted',
            ], 200);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Order Deleted Successfully'
        ], 200);
    }
}
