<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('events')
            ->whereDate('eventDate','>=', date('Y-m-d'))
            ->where('winnerId','=',0)
            ->join('venues','venueId','=','venues.id')
            ->select('events.*','venues.name as venueName')
            ->orderBy('events.eventDate', 'asc')
            ->get();

        return $messages->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        return $event;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        return $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response('',204);
    }

    public function ranking(){

        $ranking = DB::table('events')
            ->join('users', 'winnerId', '=', 'users.id')
            ->select(DB::raw("ROW_NUMBER() OVER() AS Position"),"users.name",DB::raw("count(events.winnerId) as Wins"))
            ->orderBy('Position')
            ->groupBy("users.name")
            ->get();

        return $ranking->toArray();

    }
}
