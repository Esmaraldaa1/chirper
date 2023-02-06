<?php

namespace App\Listeners;

use App\Events\ChirpCreated; //zodat je het event ChirpCreated kan gebruiken hier
use App\Models\User; //zodat je het User model kan gebruiken
use App\Notifications\NewChirp; //zodat je de notificatie (mail) NewChirp event kan gebruiken
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

//shouldQueue vertelt dat de listener in de queue moet worden gezet, zodat het niet allemaal tegelijk gebeurd
class SendChirpCreatedNotifications implements ShouldQueue{

    public function __construct()
    {
        //
    }

    public function handle(ChirpCreated $event) //handle verteld hoe je het event wilt uitvoeren
    {
        // whereNot betekend dat je alle users wilt selecteren behalve degene die het bericht heeft geplaatst
        //cursor betekend dat je de data niet in een keer in de geheugen laad, maar dat je het in stukjes doet. Hierdoor is het sneller en gebruikt minder geheugen
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}

