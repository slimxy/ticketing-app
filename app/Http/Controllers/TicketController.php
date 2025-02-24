<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // Get tickets based on the user's table

        $tickets = auth()->user()->role === 'organisation'
                            ?
        Ticket::where('organisation_id', 
        auth()->id())->get() : Ticket::where('customer_id', auth()->id())->get();
            
            return view('tickets.index',compact('tickets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            // only orgs can create tickets
        $this->authorize('create',Ticket::class);
         // fetch clients to assign tickets
        $clients = User::where('role','client')->get();
        return view('tickets.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate input

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'customer_id' => 'required|exists:users,id',
        ]);

        // create a new ticket
        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'customer_id' => $request->customer_id,
        ]);

        return
        redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // Authorize access to the ticket
        $this->authorize('view',$ticket);
        return view('tickets.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // Authorize access to the ticket
        $this->authorize('update',$ticket);
        return view ('tickets.edit',compact('ticket'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Authorize access to the ticket
        $this->authorize('update',$ticket);

        // validate  and update the ticket

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in-progress,closed',
        ]);

        $ticket->update($request->only([
            'title','description','status'
        ]));
    //     $ticket->update([    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'status' => $request->status,
    //     ]);

        return redirect()->route('tickets.index')->with('success','Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //Authorize access to the ticket
        $this->authorize('delete',$ticket);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success','Ticket deleted successfully.');
    }
}
