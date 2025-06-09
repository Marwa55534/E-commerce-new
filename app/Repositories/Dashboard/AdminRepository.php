<?php

namespace App\Repositories\Dashboard;

use App\Models\Admin;

class AdminRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function getAdmins(){
        $admins = Admin::select('id','name','email','role_id','status','created_at')->paginate(5);
        return $admins;
    }

    public function getAdmin($id){
        $admin = Admin::find($id);
        return $admin;
        
    }

    public function storeAdmin($request){
       $admin = Admin::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        'role_id'=>$request->role_id,
        'status'=>$request->status,

       ]); 
       return $admin;
    }

    public function updateAdmin($data , $admin){
        // $admin = self::getAdmin($id);
        $admin = $admin->update(
           $data
 
        ); 
        return $admin;
    }

    public function deleteAdmin($admin){
        return $admin->delete();
    }

    public function changeStatus($admin , $status){
        
        $admin = $admin->update([
            'status'=>$status,
        ]);
        return $admin;
    }

    public function searchByAjax($request){
        $admins = Admin::where('name','LIKE','%'.$request->ajax_search_value.'%')
                    ->orWhere('email','LIKE','%'.$request->ajax_search_value.'%')
                    ->orWhere(function($query) use($request){
                        $query->whereRelation('role','role','LIKE','%'.$request->ajax_search_value.'%');
                    })->get();
        return $admins;            
    }

}
