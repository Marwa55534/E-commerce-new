<?php

namespace App\Livewire\Dashboard\Contact;

use App\Services\Dashboard\ContactService;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Contact;

class ReplayContact extends Component
{
    public $id, $email, $subject, $replayMessage, $clientName, $contact;

    protected ContactService $contactService;

    public function boot(ContactService $contactService){
        $this->contactService = $contactService; 
    }

     // Listening 
     #[On('call-replay-contact')] 
    public function luanchModal($contactId){

        $this->setDataInAttributs($contactId);  // تعبئة البيانات
        $this->dispatch("luanch-replay-contact-model"); //event -> lisiting blade replay-contact
    }

    public function setDataInAttributs($contactId){
        $this->contact = Contact::find($contactId);
       
        $this->id = $this->contact->id;
        $this->email = $this->contact->email;
        $this->subject = $this->contact->subject;
        $this->clientName = $this->contact->name;
    }

    public function replayContact(){
        $replayStatus = $this->contactService->replayContact($this->id,$this->replayMessage);
        if(!$replayStatus){
            return ;
        }

        // events
        $this->dispatch('close-model'); // events -> lisiting blade replay-contact
        // $this->dispatch('replay-contact-success');

    }
    public function render()
    {
        return view('livewire.dashboard.contact.replay-contact');
    }
}
