<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\ContactService;

class ContactController extends Controller
{
    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    
    public function index(){
        return view('dashboard.contacts.index'); 
    }
}
