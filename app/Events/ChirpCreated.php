<?php

namespace App\Events;

use App\Models\Chirp; //zodat je de Chirp kan gebruiken
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChirpCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // __construct is een speciale functie binnen een class die automatisch wordt uitgevoerd als je een nieuwe instantie van de class maakt. Instantie betekend dat je een nieuwe variabele maakt van een class
    public function __construct(public Chirp $chirp) //dit verstuurd de chirp naar het event en verstuurd dan de notificatie
    {
        //
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
