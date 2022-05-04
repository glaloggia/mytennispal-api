<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Http\Requests\StoreRsvpRequest;
use App\Http\Requests\UpdateRsvpRequest;

class RsvpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rsvp::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRsvpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRsvpRequest $request)
    {
        $rsvp = Rsvp::create($request->all());
        return $rsvp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function show(Rsvp $rsvp)
    {
        return $rsvp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRsvpRequest  $request
     * @param  \App\Models\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRsvpRequest $request, Rsvp $rsvp)
    {
        $rsvp->update($request->all());
        return $rsvp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rsvp $rsvp)
    {
        $rsvp->delete();
        return response('',204);
    }
}
