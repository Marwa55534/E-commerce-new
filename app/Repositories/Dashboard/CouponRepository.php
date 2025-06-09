<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll(){
        $coupons = Coupon::latest()->get();
        return $coupons;
    }

    public function getCoupon($id){
        $coupon = Coupon::find($id);
        return $coupon;
    }

    public function store($data){
        $coupon = Coupon::create($data);
        return $coupon;
    }

    public function update($coupon,$data){ //id

        $coupon = $coupon->update($data);
        return $coupon;
    }

    public function delete($coupon){ //id
        return $coupon->delete($coupon);
    }
}
