<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\UserService;
use App\Models\Order;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
    */

    public function index()
    {
        return view('dashboard.users.index');
        
    }

    public function getAll(){
        return $this->userService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(UserRequest $request)
    {
        $data = $request->only([
            'name','email','mobile','password','country_id','governorate_id','city_id','status','image'
        ]);

        $user = $this->userService->store($data);
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
        ],201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // تحقق إذا كان المستخدم له طلبات لم تُسلم بعد
        // $userOrders = Order::where('user_id', $id)
        //     ->whereIn('status', ['pending', 'completed'])
        //     ->exists(); 
 
        // if ($userOrders) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'You cannot delete the user because they have orders that are not delivered.',
        //     ], 400); // يمكن تغيير الكود إلى 400 بدلًا من 500
        // }
        
        $user = $this->userService->delete($id);   
        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg')
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }

    public function changeStatus(Request $request){
        $user = $this->userService->changeStatus($request); 
        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg')
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }

   

}
