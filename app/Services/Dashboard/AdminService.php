<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AdminRepository;

class AdminService
{
    /**
     * Create a new class instance.
     */
    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAdmins(){
        $admins = $this->adminRepository->getAdmins();
        return $admins;
    }

    public function getAdmin($id){
        $admin = $this->adminRepository->getAdmin($id);
        if(!$admin){
            return false;
        }
        return $admin;
    }

    public function storeAdmin($request){
        $admin = $this->adminRepository->storeAdmin($request);
        if(!$admin){
            return false;
        }
        return $admin;
    }

    public function updateAdmin($data , $id){
        $admin = $this->adminRepository->getAdmin( $id);
        if(!$admin){
            abort(404);
        }
        if($data['password'] == null){
            unset($data['password']);
        }
        $admin = $this->adminRepository->updateAdmin( $data, $admin);
        if(!$admin){ 
            return false;
        }
        return $admin;
    }

    public function deleteAdmin($id){
        $admin = $this->adminRepository->getAdmin( $id);
        if(!$admin){
            abort(404);
        }
        $admin = $this->adminRepository->deleteAdmin( $admin);
        if(!$admin){
            return false;
        }
        return $admin;
    }

    public function changeStatus($id){
        $admin = $this->adminRepository->getAdmin( $id);
        if(!$admin){
            abort(404);
        }

        if($admin->status == 'Active'){
            $status = 0;
        }else{
            $status = 1;
        }
        $status = $this->adminRepository->changeStatus($admin , $status);
        return $status;
    }

    public function searchByAjax($request){
        $admins = $this->adminRepository->searchByAjax($request);
        return $admins;

    }
}
