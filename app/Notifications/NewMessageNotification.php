<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $messageContent;

    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }
    public function toArray($notifiable)
    {
        return [
            'message' => $this->messageContent,
        ];
    }
    public function via($notifiable)
    {
        return ['database'];
    }

    
}
