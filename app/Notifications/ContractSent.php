<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContractSent extends Notification
{
    use Queueable;
    protected $contract;

    /**
     * Create a new notification instance.
     */
    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('New Contract Assigned to You')
        ->greeting('Hello ' . $notifiable->name)
        ->line('A new contract has been created for the job: ' . $this->contract->job->title)
        //->action('View Contract', route('user.contract.view', $this->contract->id))
        ->line('Please review and sign it at your earliest convenience.');
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
