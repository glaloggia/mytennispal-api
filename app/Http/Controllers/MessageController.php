<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Message::where('userTo', $request->user()->id)->paginate();
//        $messages = Message::where('userTo', $request->user()->id)->get();
        $messages = DB::table('messages')
            ->where('userTo', $request->user()->id)
            ->join('users','users.id','=','messages.userFrom')
            ->select('users.name','messages.*')
            ->get();

        return $messages->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->all();
        $data['userFrom'] = $request->user()->id;
        $message = Message::create($data);

        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Message $message)
    {
        if ($request->user()->id != $message->userTo){
            return abort(403,"Unauthorized");
        }
        return $message;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        if ($request->user()->id != $message->userTo){
            return abort(403,"Unauthorized");
        }

        $message->update(request()->all());

        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Message $message)
    {
        if ($request->user()->id != $message->userTo){
            return abort(403,"Unauthorized");
        }
        $message->delete();
        return response('',204);
    }
}
