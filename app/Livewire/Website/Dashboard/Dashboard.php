<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $screen = 'dashboard';
    public $auth_user;
    public $new_order_count;
    public $delivered_order_count;

    public function mount($auth_user , $new_order_count , $delivered_order_count){
        $this->auth_user = $auth_user;
        $this->new_order_count = $new_order_count;
        $this->delivered_order_count = $delivered_order_count;
    }

    #[On('dashboardSelectScreen')]
    public function selectScreen($screen){
        $this->screen = $screen; 
    }
    public function render()
    {
        return view('livewire.website.dashboard.dashboard');
    } 
}
