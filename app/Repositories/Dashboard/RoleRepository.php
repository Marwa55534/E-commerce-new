<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

class RoleRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    { 
        //
    }

    public function getRole($id){
        $role = Role::findOrFail($id);
        return $role;
    }

    public function createRole($request){

        // create in db
        $role = Role::create([
            'role'=>[
                'ar'=>$request->role['ar'],
                'en'=>$request->role['en'],           

            ],    
            'permession'=>json_encode($request->permession),
        ]);
        return $role;
    }

    public function getRoles(){
        $roles = Role::select('id', 'role' ,'permession')->paginate(5);
        return $roles;
    }

    public function updateRole($request, $role){
        // update in db
        $role = $role->update([
            'role'=>[
                'ar'=>$request->role['ar'],
                'en'=>$request->role['en'],           

            ],    
            'permession'=>json_encode($request->permession),  
        ]);
        return $role;
    }

    public function deleteRole($role){
        // delete in db
        $role = $role->delete();
        return $role;
    }

}
