<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\OrderRepository;
use Yajra\DataTables\Facades\DataTables;

class OrderService
{
    /**
     * Create a new class instance.
     */
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAll($request){
        $orders = $this->orderRepository->getAll(); 

        if($request->has('status') && $request->status != ''){
            $orders->where('status' , $request->status);
        }

        return DataTables::of($orders)
        ->addIndexColumn()
        ->addColumn('status',function($order){ 
            return $order->status;
        })
        ->addColumn('coupon',function($order){ 
            return $order->coupon ?? __('dashboard.no_coupon');
        })
        ->addColumn('operations',function($order){
            return view('dashboard.orders.datatables.actions' , compact('order'));
        })
        ->make(true); // بترجع الداتا في هيئه اوبجكت
    }

    public function destroy($id){
        $order = $this->orderRepository->show($id);
        if(!$order){
            return false;
        }

        if($order->status == 'delivered' || $order->status == 'cancelled'){
            return $this->orderRepository->destroy($order);
        }
        return false;
    }

    public function getOrderWithItemsById($id){
        $order = $this->orderRepository->getOrderWithItemsById($id);
        if(!$order){
            return false; 
        }
        return $order;
    }

     public function markeOrderAsDelivered($id){

        $order = $this->orderRepository->show($id);
        if(!$order){
            return false; 
        }
        return $this->orderRepository->markeOrderAsDelivered($order);
        
    }
}
