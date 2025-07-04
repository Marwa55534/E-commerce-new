<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Services\Dashboard\RoleService;
use App\Models\Role;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleService $roleService) 
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.roles.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.createRoles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleService->createRole($request);
        if(! $role){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return redirect()->back()->with('success',__('dashboard.success_msg') );

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
        $role = $this->roleService->getRole($id);
        if(! $role){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return view('dashboard.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = $this->roleService->updateRole($request , $id);
        if(! $role){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return redirect()->back()->with('success',__('dashboard.success_msg') );

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->roleService->deleteRole($id);
        if(! $role){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return redirect()->back()->with('success',__('dashboard.success_msg') );
    }
}
