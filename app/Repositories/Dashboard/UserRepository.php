<?php

namespace App\Repositories\Dashboard;

use App\Models\User;
use App\Models\Order;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){
        $users = User::latest()->get();
        return $users;
    }

    public function getUser($id){
        $user = User::find($id);
        return $user;
    }

    public function store($data){
        return User::create($data);
    }

    public function changeStatus($user , $status){
        $user->status = $status;
        return $user->save(); 
    }

    public function delete($user){
        return $user->delete();  
    }

    public function hasPendingOrCompletedOrders($userId)
    {
        return Order::where('user_id', $userId)
            ->whereIn('status', ['pending', 'completed'])
            ->exists();
    }
}
