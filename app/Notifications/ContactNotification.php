<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ContactNotification extends Notification implements ShouldBroadcast 
{
    use Queueable;
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new notification instance.
     */
    public $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'contact_id' => $this->contact->id,
            'user_name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
            'message' => 'You Recived New contact',
            'created_at' => now()->toDateTimeString(),
        ];
    }


    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'contact_id' => $this->contact->id,
            'user_name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
            'message' => 'You Recived New contact',
            'created_at' => now()->toDateTimeString(),
        ]);
    }

    public function databaseTybe(object $notifiable): string
    {
        return 'ContactNotification';
    }

    public function broadcastTybe(object $notifiable): string
    {
        return 'ContactNotification';
    }
}
