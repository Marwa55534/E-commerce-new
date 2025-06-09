<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\UserRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Image;

class UserService
{
    /**
     * Create a new class instance.
     */
    protected $userRepository, $image;
    public function __construct(UserRepository $userRepository , Image $image)
    {
        $this->userRepository = $userRepository;
        $this->image = $image;

    }

    public function getAll(){

        $users = $this->userRepository->getAll();
        return DataTables::of($users) 
        ->addIndexColumn()

        // ->addColumn('name' , function ($user){
        //     return $user->getTranslation('name', app()->getLocale());
        // })
        ->addColumn('status' , function ($user){
            return $user->getStatusTranslated();
        })
        ->addColumn('country' , function($user){
            return $user->country->name;
        })
        ->addColumn('governorate' , function($user){
            return $user->governorate->name;
        })
        ->addColumn('city' , function($user){
            return $user->city->name;
        })
        ->addColumn('num_of_orders' , function($user){
            return $user->orders()->count() > 0 ? $user->orders()->count() : __('dashboard.not_found');
        })
        ->addColumn('image', function ($user) {
            return view('dashboard.users.datatables.image', compact('user'));
        })
        ->addColumn('action', function ($user) {
           return view('dashboard.users.datatables.actions'  ,compact('user'));
        })
        ->make(true);
    }

    public function getUser($id){
        $user = $this->userRepository->getUser($id);
        return $user ?? abort(404);
    }

    public function store($data){

        if(array_key_exists('image',$data) && $data['image'] != null){ // يعني فيه صوره 
            $file_name = $this->image->uploadSingleImage('/' , $data['image'] , 'users');
            $data['image'] = $file_name;
        }

       $user = $this->userRepository->store($data);
       if(!$user){
        return false;
       }
       return $user;
    }

    public function delete($id){
        $user = $this->getUser($id);

        // check if has image
        if($user->image != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal($user->image);
        }

        if ($this->userRepository->hasPendingOrCompletedOrders($user->id)) {
            throw new \Exception('You cannot delete the user because they have orders that are not delivered.');
        }
        
        return $this->userRepository->delete($user);
    }

    public function changeStatus($request){
        $user = $this->getUser($request->id);
        $user->status == 1 ? $status = 0 : $status = 1;
        return $this->userRepository->changeStatus($user , $status);
    }
}
