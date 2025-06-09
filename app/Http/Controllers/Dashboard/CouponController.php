<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\CouponService;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    protected $couponService;
    public function __construct(CouponService $couponService) 
    {
        $this->couponService = $couponService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.coupons.index');
    }

    public function getAll(){
        return $this->couponService->getAll(); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.coupons.createCoupon'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $data = $request->except(['_token']);
        $coupon = $this->couponService->store($data);
        if(! $coupon){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
            // return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);

        // return redirect()->back()->with('success',__('dashboard.success_msg') );

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = $this->couponService->getCoupon($id);
        return view('dashboard.coupons.',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        $data = $request->except(['_token']);
        $coupon = $this->couponService->update($id,$data);
        if(! $coupon){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
            // return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);
        // return redirect()->back()->with('success',__('dashboard.success_msg') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = $this->couponService->delete($id);
        if(! $coupon){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
            // return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);
        // return redirect()->back()->with('success',__('dashboard.success_msg') );
        
    }
}
