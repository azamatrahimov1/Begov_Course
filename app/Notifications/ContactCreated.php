<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactCreated extends Notification
{
    use Queueable;

    public $contact;
    /**
     * Create a new notification instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->contact->id,
            'full_name' => $this->contact->full_name,
            'desc' => $this->contact->desc,
            'created_at' => $this->contact->created_at,
        ];
    }
}
