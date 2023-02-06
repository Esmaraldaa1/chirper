<?php

namespace App\Http\Controllers;

use App\Models\Chirp; // dit zorgt ervoor dat je de Chirp model kan gebruiken
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChirpController extends Controller
{
    public function index()
    {
        return Inertia::render('Chirps/Index', [  //renderen betekend dat je een opgemaakte pagina aanmaakt. In dit geval de index pagina van chirps
            'chirps' => Chirp::with('user:id,name')->latest()->get(),  //with betekend dat je de user id en name wilt zien. latest betekend dat je de nieuwste chirps bovenaan wilt zien. get betekend dat je alle chirps wilt zien adhv hetgene wat je hebt oppgevraagd.
        ]);
    }

    public function create()
    {
        //
    }

    //Toegevoegd zodat het bericht (chirp) nu gevalideerd wordt
    public function store(Request $request)
    {
        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    public function show(Chirp $chirp)
    {
        //
    }

    public function edit(Chirp $chirp)
    {
        //
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
