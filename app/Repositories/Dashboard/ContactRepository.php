<?php

namespace App\Repositories\Dashboard;

use App\Models\Contact;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() 
    {
        //
    }

    public function getMarkReadContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->read()->latest();
    }
    public function getMarkUnreadContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->unread()->latest();
    }
    public function getAnsweredContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->answered()->latest();
    }

    public function getInboxContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->latest();
    }
    public function getTrashedContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->onlyTrashed()->latest();
    }

    public function getStarredContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->starred()->latest();
    }

    public function getUnstarredContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->unstarred()->latest();
    }



    public function getContacts(){
        return Contact::get();
    }

    public function getMarkReadContact(){
        return Contact::where('is_read',1)->get();
    }

    public function getContactById($id){
        return Contact::withTrashed()->find($id);

    }

    public function deleteContact($contact){
        return $contact->delete();
    }

    public function deleteAllReadContacts(){ 
        return Contact::read()->delete(); 
        
    }
    public function deleteAllAnswereContacts(){
        return Contact::answered()->delete(); 
    }

    public function markAllAsRead(){
        $contacts = Contact::get();
        foreach ($contacts as $contact) {
            $contact->is_read = 1;
            $contact->save();
        }
        return true;
    }
    // read
    public function markRead($contact){
        $contact->is_read = 1;
        $contact->save();
    }

    public function markUnread($contact){
        $contact->is_read = 0;
        $contact->save();
    }

    // stare
    public function getMarkStarredContact(){
        return Contact::where('is_starred',1)->get();
    }
    public function markAsStarred($contact){
        $contact->is_starred = 1; 
        $contact->save();
    }

    public function markUnstarred($contact){
        $contact->is_starred = 0;
        $contact->save();
    }

    public function markAllAsStar(){
        $contacts = Contact::get();
        foreach ($contacts as $contact) {
            $contact->is_starred = 1;
            $contact->save();
        }
        return true;
    }

    // spam
    public function getSpamContacts(){
        return Contact::where('is_spam', 1)->get();
    }

    public function markAsSpam($contact){
        $contact->is_spam = 1; 
        $contact->save();
    }

    public function markUnspam($contact){
        $contact->is_spam = 0;
        $contact->save();
    }

    // soft delete
    public function restoreContact($contact){
        return $contact->restore();
    } 

    public function restoreAllContacts(){
        return Contact::onlyTrashed()->restore();
    }

    public function cancelSpams(){
        return Contact::where('is_spam', 1)->update(['is_spam' => 0]);
    }

    public function forceDeleteContact($contact){
        return $contact->forceDelete();
    }
}
 