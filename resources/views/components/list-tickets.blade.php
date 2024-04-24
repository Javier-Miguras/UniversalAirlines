<div>
    <div class="p-6 md:px-8 md:py-12">
        <h1 class="text-4xl font-bold text-slate-800 text-center mb-8">My Tickets</h1>
        @if($tickets->count() > 0)
            <div>
                @foreach ($tickets as $ticket)
                    <div class="mb-4">
                        <div class="text-center bg-cyan-100 py-2  border-t border-l border-r border-slate-300">
                            <h3 class="text-cyan-600 text-xl font-semibold">Ticket #<span class="text-xl font-bold">{{ $ticket->ticket_code }}<span></h3>
                        </div>
                        <div class="sm:flex sm:justify-between sm:items-center p-6 border border-slate-300">
                            <div class="space-y-2">
                                <h4 class="text-lg font-bold text-slate-800">{{ $ticket->flight->origin }} / {{ $ticket->flight->destination }} <span class="font-normal">{{ $ticket->flight->date->format('d-m-Y') }}</span></h4>
                                <p class="text-slate-800 text-sm">{{ $ticket->flight->departure_terminal }} {{ $ticket->flight->departure_time }}</p>
                                <p class="text-slate-800 text-sm">Seat number {{ $ticket->seat }}</p>
                            </div>
                            <div>
                                <a href="{{ route('tickets.index', $ticket->ticket_code) }}" target="_blank" class="bg-amber-400 block text-white py-1 px-4 rounded-sm font-semibold hover:bg-amber-600 mt-4 text-center sm:mt-0" target="_blank">View Full Ticket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600 text-lg">Still no tickets, go to our <a href="{{ route('home') }}" class="font-semibold text-rose-500 hover:text-rose-400">homepage</a> to book a flight.</p>
        @endif
    </div>
</div>