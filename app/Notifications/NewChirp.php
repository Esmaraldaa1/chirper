<?php

namespace App\Notifications;

use App\Models\Chirp; //toegevoegd zodat je de chirp kan gebruiken/benaderen
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification
{
    use Queueable; //Queueable betekend dat je een notificatie kan queue in de database, dus het wordt niet allemaal tegelijk verstuurd

    public function __construct(public Chirp $chirp)
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage) //inhoud van de mail hieronder
            ->subject("New Chirp from {$this->chirp->user->name}")
            ->greeting("New Chirp from {$this->chirp->user->name}")
            ->line(Str::limit($this->chirp->message, 50))
            ->action('Go to Chirper', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
