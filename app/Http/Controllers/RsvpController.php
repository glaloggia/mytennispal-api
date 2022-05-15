<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Http\Requests\StoreRsvpRequest;
use App\Http\Requests\UpdateRsvpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RsvpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

    public function myBookings(int $playerId){

        $rsvps = DB::table('rsvps')
            ->where('playerId', $playerId)
            ->join('events','events.id','=','rsvps.eventId')
            ->where('eventDate','>',today())
            ->get();

        return $rsvps->toArray();
    }

    public function getMeAttendance(int $eventId){
        $attendance = DB::table('rsvps')
            ->where('rsvps.eventId',$eventId)
            ->join('users','rsvps.playerId','=','users.id')
            ->select('users.*')
            ->get();
        return $attendance->toArray();
    }

}
