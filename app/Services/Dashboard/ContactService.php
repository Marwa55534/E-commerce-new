<?php

namespace App\Services\Dashboard;

use App\Livewire\Dashboard\Contact\ReplayContact;
use App\Repositories\Dashboard\ContactRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplayContactMail;

class ContactService
{
    /**
     * Create a new class instance.
     */
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getMarkReadContacts($keyword = null)
    {
        return $this->contactRepository->getMarkReadContacts($keyword);
    }
    public function getUnreadContacts($keyword = null)
    {
        return $this->contactRepository->getMarkUnreadContacts($keyword);
    }
    public function getInboxContacts($keyword = null)
    {
        return $this->contactRepository->getInboxContacts($keyword);
    }
    public function getAnsweredContacts($keyword = null)
    {
        return $this->contactRepository->getAnsweredContacts($keyword);
    }
    public function getTrashedContacts($keyword = null)
    {
        return $this->contactRepository->getTrashedContacts($keyword);
    }

    public function getStarredContacts($keyword = null)
    {
        return $this->contactRepository->getStarredContacts($keyword);
    }

    public function getUnstarredContacts($keyword = null)
    {
        return $this->contactRepository->getUnstarredContacts($keyword);
    }


    public function getContacts(){
        return $this->contactRepository->getContacts();
    }

    public function getMarkReadContact(){
        return $this->contactRepository->getMarkReadContact();
    }

    public function getContactById($id){
        $contact = $this->contactRepository->getContactById($id);
        return $contact ?? false;
    }

    public function deleteContact($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->deleteContact($contact);
    }

    // read
    public function markRead($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markRead($contact);
    }

    public function markUnread($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markUnread($contact);
    }

    // star
    public function markAsStarred($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markAsStarred($contact);
    }

    public function markUnstarred($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markUnstarred($contact);
    }

    public function getMarkStarredContact(){
        return $this->contactRepository->getMarkStarredContact();
    }

    public function markAllAsStar(){
        return $this->contactRepository->markAllAsRead();
    }

     // spam
     public function getSpamContacts(){
        return $this->contactRepository->getSpamContacts();
    }

    public function markAsSpam($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markAsSpam($contact);
    }

    public function markUnspam($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->markUnspam($contact);
    }

    public function replayContact($contactId , $replayMessage){
        $contact = $this->getContactById($contactId);
        if(!$contact){
            return false;
        }
        Mail::to($contact->email)->send(new ReplayContactMail($replayMessage,$contact->name , $contact->subject));

        return true;
    }

    public function deleteAllReadContacts(){
        return $this->contactRepository->deleteAllReadContacts();
    }
    public function deleteAllAnswereContacts(){
        return $this->contactRepository->deleteAllAnswereContacts();
    }

    public function markAllAsRead(){
        return $this->contactRepository->markAllAsRead();
    }
   

    // soft delete
    public function restoreContact($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->restoreContact($contact);
    }

    public function restoreAllContacts(){
        return $this->contactRepository->restoreAllContacts();
    }

    public function cancelSpams(){
        return $this->contactRepository->cancelSpams();
    }

    public function forceDeleteContact($id){
        $contact = $this->getContactById($id);
        if(!$contact){
            return false;
        }
        return $this->contactRepository->forceDeleteContact($contact);

    }
}

//Repository امتي استخدم ال 
// لو انا عايزه اسيف الرد عندي ف الداتا بيز
// اعمل حقل ف جدول الكونتكت اسمه ريبلاي