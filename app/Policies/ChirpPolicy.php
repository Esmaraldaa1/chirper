<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChirpPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Chirp $chirp)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Chirp $chirp) //update betekend dat je (alleen de gebruiker) een chirp kan updaten/aanpassen
    {
        return $chirp->user()->is($user); //is betekend dat je de gebruiker wilt vergelijken met de chirp
    }

    public function delete(User $user, Chirp $chirp) // alleen de gebruiker kan een chirp verwijderen
    {
        return $this->update($user, $chirp); //this betekend dat je deze functie update wilt gebruiken
    }

    public function restore(User $user, Chirp $chirp)
    {
        //
    }

    public function forceDelete(User $user, Chirp $chirp)
    {
        //
    }
}
