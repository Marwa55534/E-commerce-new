<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
    /**
     * Create a new class instance.
     */
    protected $couponRepository;
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }
    
    public function getAll(){
        $coupons = $this->couponRepository->getAll();

        return DataTables::of($coupons) 
        ->addIndexColumn()
        ->addColumn('is_active', function ($coupon) {  
            return $coupon->getStatus();
        })
        ->addColumn('discount_percentage', function ($coupon) {  
            return $coupon->discount_percentage . '%';
        })
        ->addColumn('action', function ($coupon) {
            return view('dashboard.coupons.datatables.actions', compact('coupon'));
        })
        ->make(true);

    }

    public function getCoupon($id){
        $coupon = $this->couponRepository->getCoupon($id);
        if(! $coupon){
            abort(404);
        }
        return $coupon;
    }

    public function store($data){
        return $this->couponRepository->store($data);
    }

    public function update($id,$data){ 
        $coupon = $this->getCoupon($id);
        return $this->couponRepository->update($coupon , $data);
    }

    public function delete($id){ 
        $coupon = $this->getCoupon($id);
        return $this->couponRepository->delete($coupon);
    }
}
