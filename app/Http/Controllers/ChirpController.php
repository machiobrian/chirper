<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use App\Models\Chirp;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index(): Response{
    //     // print hello world
    //     return response('Hello World');
    // }
    public function index(): View{
        return view("chirps.index", [
            // pass sth to the index page
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse{
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        // create a record for the user in the index
        $request->user()->chirps()->create($validated);
        // return a redirect response to return user to index
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        // only the user with proper authoriation can edit  a chirp
        $this->authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        //
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message'=> 'required|string|max:255',
        ]);

        $chirp->update($validated);
        
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
