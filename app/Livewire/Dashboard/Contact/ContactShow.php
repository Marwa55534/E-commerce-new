<?php

namespace App\Livewire\Dashboard\Contact;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Contact;
use App\Services\Dashboard\ContactService;

class ContactShow extends Component
{
    public $contact ; 
    public $selectedContacts = [];
    protected $listeners = [
        'refresh-show'=>'$refresh',
    ];
    protected ContactService $contactService;
    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    // حل اخر
    public function mount(){
        $this->contact = Contact::latest()->first();
    }


    // Listening 
    #[On('show-contact')] 
    public function showContact($contactId)
    {
        $this->contact = $this->contactService->getContactById($contactId); 
        // $this->contact = Contact::withTrashed()->where('id',$contactId)->first();
        $this->dispatch('refresh-contact');
       
    }

    // event
    public function replayContact($contactId){
      
        $this->dispatch("call-replay-contact" , $contactId); //event -> Listening ReplayContact

    }
    public function markUnread($contactId){
        $this->contactService->markUnread($contactId);
        $this->dispatch("refresh-contact"); //event 
    }

    public function markUnstarred($contactId){
        $this->contactService->markUnstarred($contactId);
        $this->dispatch("refresh-contact"); //event 
    }

    public function markAsSpam($contactId){ 
        $this->contactService->markAsSpam($contactId);
        $this->dispatch('refresh-contact'); // تحديث العرض بعد التغيير
    }

    public function markUnspam($contactId){ 
        $this->contactService->markUnspam($contactId);
        $this->dispatch('refresh-contact'); // تحديث العرض بعد التغيير
        Session::flash('message', 'The message has been successfully transferred to the mail.');

    }

    

    public function forceDeleteContact($contactId){
        $this->contactService->forceDeleteContact($contactId);
        $this->contact = Contact::latest()->first();
        $this->dispatch("delete-contact" , 'contact delete successfuly'); //event
        $this->dispatch("refresh-show"); //event

    }

    public function restoreContact($contactId){
        $this->contactService->restoreContact($contactId);
        $this->dispatch("refresh-contact" ); //event
    }

    // event 
    public function deleteContact($contactId){
        Contact::where('id',$contactId)->delete();
        $this->contact = Contact::latest()->first();
        $this->dispatch("delete-contact" , 'contact delete successfuly'); //event
        $this->dispatch("refresh-show"); //event

    }


    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');  
    }
}
