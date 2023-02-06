<?php

namespace App\Models;

use App\Events\ChirpCreated; //zodat je het event ChirpCreated kan gebruiken hier
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model //extends betekend dat je de class Chirp wilt uitbreiden met de class Model
{
    use HasFactory; //HasFactory betekend dat je de factory wilt gebruiken, Dit is een Eloquent model dat linkt naar een model factory van Laravel (om data te genereren om te testen)

    // fillable betekend dat je alleen deze kolommen kan invullen om mass assignment vulnerability te voorkomen. Ik geef hier aan dat je nu een bericht kan posten
    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [ //dispatched betekend dat je het event wilt verzenden/uitvoeren
        'created' => ChirpCreated::class,
    ];

    public function user()

    {
        return $this->belongsTo(User::class); //belongsTo refereert naar iets, in dit geval naar de user
    }
}
