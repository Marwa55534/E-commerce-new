<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Component;

class Sidebar extends Component
{
    public $screen = 'dashboard';
    public function selectScreen($screen){
        $this->screen = $screen;

        $this->dispatch('addressSelectScreen',$screen);
        $this->dispatch('passwordSelectScreen',$screen);
        $this->dispatch('dashboardSelectScreen',$screen);
        $this->dispatch('ordersSelectScreen',$screen);
        $this->dispatch('personalSelectScreen',$screen);
        $this->dispatch('wishlistSelectScreen',$screen); 
        $this->dispatch('reviewSelectScreen',$screen); 

    }
    
    public function render()
    {
        return view('livewire.website.dashboard.sidebar');
    }
}
