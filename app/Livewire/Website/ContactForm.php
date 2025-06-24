<?php

namespace App\Livewire\Website;

use App\Models\Contact;
use Auth;
use Livewire\Component;
use App\Models\Admin;
use App\Notifications\ContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $phone = '';
    public string $message = '';

    protected function rules() {
        return [
            'name'=>['required' , 'string' ,'min:2' , 'max:60'],
            'email'=>['required' , 'email' , 'max:100'],
            'phone'=>['required' , 'string' , 'max:20'],
            'subject'=>['required' , 'string' , 'max:225'],
            'message'=>['required' , 'string' , 'max:225'],
        ];
    }

    public function update($field){
        $this->validateOnly($field);
    }

    public function submitContactForm(){
        $this->validate();

        $contact = Contact::create([
            'user_id'=> Auth::check() ? Auth::id() : null , 
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'subject'=>$this->subject,
            'message'=>$this->message,
            'is_read'=>false,
        ]);

        $admins = Admin::all();
        Notification::send($admins , new ContactNotification($contact));

        if(!$contact){
            $this->dispatch('contact-form-submit','try again latter');
        }

        $this->reset('name','email','phone','message','subject');
        $this->dispatch('contact-form-submit','contact created successfyl');

    }
    public function render()
    {
        return view('livewire.website.contact-form');
    } 
}
