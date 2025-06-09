<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;
use App\Services\Dashboard\ContactService;
use App\Models\Contact;
use Livewire\Attributes\On;

class ContactSidebar extends Component
{
    public $screen = 'inbox'; // by defult
    public $selectedContacts = [];


    protected $listeners = [
        'delete-contact'=>'$refresh',
        'refresh-contact'=>'$refresh',

    ];

    protected ContactService $contactService;
    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function selectScreen($screen){
        $this->screen = $screen;
        // event
        $this->dispatch('select-screen',$screen);  // event -> lisining ContactMessages

    }

    // delete all
    public function deleteAllReadContacts(){
        $this->contactService->deleteAllReadContacts();
        $this->dispatch('delete-contact');
    }
    public function deleteAllAnswereContacts(){
        $this->contactService->deleteAllAnswereContacts();
        $this->dispatch('delete-contact');
    }

    public function markAllAsRead(){
        $this->contactService->markAllAsRead();
        $this->dispatch('delete-contact');
    }

    public function restoreAllContacts(){
        $this->contactService->restoreAllContacts();
        $this->dispatch('refresh-contact'); // مثال على إرسال حدث بعد التنفيذ
    }

    public function cancelSpams(){
        $this->contactService->cancelSpams(); 
        $this->dispatch('refresh-contact'); // مثال على إرسال حدث بعد التنفيذ
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-sidebar',[
            'inboxCount' => $this->contactService->getInboxContacts()->count(),
            'answeredCount'=> $this->contactService->getAnsweredContacts()->count(),
            'readedCount'=> $this->contactService->getMarkReadContacts()->count(), 
            'trashedCount'=> $this->contactService->getTrashedContacts()->count(),
            'starredCount'=> $this->contactService->getStarredContacts()->count(),
            'spamCount'=> $this->contactService->getSpamContacts()->count(),
        ]);
    }
}
