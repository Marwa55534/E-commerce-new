<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class CreateOrderNotification extends Notification implements ShouldBroadcast 
{
    use Queueable;
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $order;
    // protected $notifiable; // خاصية جديدة لتخزين $notifiable

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $this->notifiable = $notifiable; // تهيئة الخاصية
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
            'order_id' => $this->order->id,
            'user_name' => $this->order->user_name,
            'total_price' => $this->order->total_price,
            'status' => $this->order->status,
            'message' => 'New Order has been Paid Successfuly',
            'created_at' => now()->toDateTimeString(),
        ];
    }

    public function databaseTybe(object $notifiable): string
    {
        return 'CreateOrderNotification';
    }


    // public function toBroadcast(object $notifiable): BroadcastMessage
    // {

    //     return new BroadcastMessage([
    //         'order_id' => $this->order->id,
    //         'user_name' => $this->order->user_name,
    //         'total_price' => $this->order->total_price,
    //         'status' => $this->order->status,
    //         'message' => 'New Order has been Paid Successfully',
    //         'created_at' => now()->toDateTimeString(),
    //     ]);
    // }

    

    public function toBroadcast(object $notifiable): BroadcastMessage
{
    $data = [
        'order_id' => $this->order->id,
        'user_name' => $this->order->user_name,
        'total_price' => $this->order->total_price,
        'status' => $this->order->status,
        'message' => 'New Order has been Paid Successfully',
        'created_at' => now()->toDateTimeString(),
    ];
    \Log::info('Broadcasting CreateOrderNotification:', $data);
    return new BroadcastMessage($data);
}
    
    
    public function broadcastTybe(object $notifiable): string
    {
        return 'CreateOrderNotification';
    }



   
}
