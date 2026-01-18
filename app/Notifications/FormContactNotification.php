<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormContactNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $formData;
    public $header;
    public $message;
    public function __construct($formData)
    {
        $this->formData = $formData;
        $this->header = 'New Message From Customer';
        $this->message = 'New Message From WebSite With This Data:';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
       return (new MailMessage())
            ->greeting(' ')
            ->subject($this->header)
            ->line('Name: ' . ($this->formData['name'] ?? ''))
            ->line('Company Name: ' . ($this->formData['company_name'] ?? ''))
            ->line('Phone: ' . ($this->formData['phone'] ?? ''))
            ->line('Email: ' . ($this->formData['email'] ?? ''))
            ->line('Message: ' . ($this->formData['message'] ?? ''))
            ->salutation(' ');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
                //
            ];
    }
}
