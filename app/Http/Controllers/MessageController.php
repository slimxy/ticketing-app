<?php

namespace App\Http\Controllers;

use App\Models\Message;
// use App\Models\User;
use App\Models\Ticket;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ticket $ticket)
    {
        //Aurthorize the user
        $this->authorize('view', $ticket);
        $messages = $ticket->messages()->with('sender')->get();

        return view('messages.index', compact('ticket', 'messages'));
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
    public function store(Request $request, Ticket $ticket)
    {
        //Aurthorize the user access
        // $this->authorize('view', $ticket);
        $this->authorize('create', $ticket);

        // Validate the input and create a message
        $request->validate([
            'message' => 'required|string',
        ]);
        $ticket->messages()->create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Message sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
