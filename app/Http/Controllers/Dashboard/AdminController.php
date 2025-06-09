<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;
use App\Services\Dashboard\AdminService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    protected $adminService , $roleService;
    public function __construct(AdminService $adminService , RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->adminService->getAdmins(); 
        return view('dashboard.admins.index',compact('admins'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.admins.createAdmin',compact('roles'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admin = $this->adminService->storeAdmin($request);
        if(!$admin){
            return redirect()->back()->with('error',__('dashboard.error_msg'));
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        if(! $admin){
            Session::flash('error','admin not found');
            return redirect()->back();
        }
        return view('dashboard.admins.show',compact('admin'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = $this->roleService->getRoles();
        $admin = $this->adminService->getAdmin($id);
        if(! $admin){
            Session::flash('error','admin not found');
            return redirect()->back();
        }
        return view('dashboard.admins.editAdmin',compact('admin','roles'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        // return $request;
        $data = $request->only(['name', 'email','status' , 'password','role_id']);
        $admin = $this->adminService->updateAdmin($data , $id);
        if(!$admin){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('admins.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = $this->adminService->deleteAdmin($id); 
        if(!$admin){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('admins.index');
    }

    Public Function changeStatus($id){
        if(!$this->adminService->changeStatus($id)){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('admins.index');
    }

    public function searchByAjax(Request $request){
        $admins = $this->adminService->searchByAjax($request);
        return view('dashboard.admins.ajax_search',compact('admins'));            
    }
}
