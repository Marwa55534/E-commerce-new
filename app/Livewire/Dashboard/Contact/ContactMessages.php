<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;
use App\Models\Contact;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Services\Dashboard\ContactService;

class ContactMessages extends Component
{ 
    use WithPagination;
    public $itemSearch , $opendContactId ;
    public  $page = 1 ;
    public $screen = 'inbox';
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

    public function updatingItemSearch(){ //itemSearch
        $this->resetPage(); // page 
    }

    // event
    public function showContact($contactId){
        $this->markRead($contactId);
        $this->dispatch("show-contact" , $contactId); 
        $this->opendContactId = $contactId;
    }
    

    public function markRead($contactId)
    {
        $this->contactService->markRead($contactId);
    }

    public function markAsStarred($contactId){
        $this->contactService->markAsStarred($contactId);
        $this->dispatch("refresh-contact"); // تحديث العرض بعد التغيير
    }


    // Listening 
    #[On('select-screen')] 
    public function selectScreen($screen)
    {
        $this->screen = $screen;
    }

    public function render()
    {
        if($this->screen == 'readed'){
            $contacts = Contact::where('is_read',1);
        }elseif($this->screen == 'answered'){
            $contacts = Contact::where('replay_status',1);
        }elseif($this->screen == 'starred'){
            $contacts = Contact::where('is_starred',1);
        }elseif($this->screen == 'trashed'){
            $contacts = Contact::onlyTrashed();
        }elseif($this->screen == 'spam'){
            $contacts = Contact::where('is_spam',1);
        }else {
            $contacts = Contact::where('is_spam', 0);
            // $contacts = Contact::query(); // inbox
        }

        // search
        if($this->itemSearch){
            $contacts->where('email','like','%'.$this->itemSearch.'%')
                    ->orWhere('name','like','%'.$this->itemSearch.'%')
                    ->orWhere('phone','like','%'.$this->itemSearch.'%');
        }
        return view('livewire.dashboard.contact.contact-messages',[
            'contacts' => $contacts->paginate(5),
        ]);

        
    }
}
