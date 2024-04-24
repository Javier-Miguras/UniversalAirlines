<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($ticket_code)
    {
        $ticket = Ticket::where('ticket_code', $ticket_code)->first();

        if($ticket != null && (auth()->user()->rol == 1 || auth()->user()->id == $ticket->user_id)){
            $flight = Flight::find($ticket->flight->id);
            $ticket_code = $ticket->ticket_code;
            $ticket->toArray();
            $user_name = $ticket->user->name;

            $pdf = Pdf::loadView('pdfs.ticket', compact('ticket', 'flight', 'user_name'));
            return $pdf->stream($ticket_code . '.pdf');
        }else{
            return redirect()->route('home');
        }
    }
}
