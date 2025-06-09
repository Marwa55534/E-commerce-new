<?php

namespace App\Repositories\Dashboard;

use App\Models\Order;

class OrderRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        // 
    }

    public function getAll(){
        $orders = Order::query()->latest();
        return $orders;
    }

    public function show($id){
        return Order::find($id); 
    }

    public function markeOrderAsDelivered($order){
        return $order->update(['status'=>'delivered']);
    }

    public function destroy($order){
       return $order->delete($order);
    }

    public function getOrderWithItemsById($id){
        return Order::with('orderItems')->find($id);
    }
}
