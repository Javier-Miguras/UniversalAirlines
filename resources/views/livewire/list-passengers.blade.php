<div class="p-6 md:px-8 md:py-12">
    @if($passengers->count() > 0)
        <div>
            @foreach ($passengers as $passenger)
                <div class="md:flex md:justify-between md:align-center border-b border-slate-300 pt-6 grid grid-cols-2">
                    <div class="mb-6 flex justify-start items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bg-slate-300 text-white w-28 rounded-lg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-md text-slate-800 font-bold mb-2 flex gap-1 items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Passenger name:      
                        </p>
                        <p class="text-md text-slate-800 text-sm mb-6">{{$passenger->name }}</p>
                        <p class="text-md text-slate-800 font-bold mb-2 flex gap-1 items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg> 
                              Passenger email:      
                        </p>
                        <p class="text-md text-slate-800 text-sm mb-6">{{ $passenger->email }}</p>
                    </div>

                    <div>
                        <p class="text-md text-slate-800 font-bold mb-2 flex gap-1 items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                            </svg> 
                              Passenger tickets:       
                        </p>
                        <div class="text-slate-800 mb-2 text-sm grid grid-cols-1">
                            @foreach ($passenger->tickets->where('flight_id', $flight->id) as $ticket)
                                <a href="{{ route('tickets.index', $ticket->ticket_code) }}" target="_blank" class="text-md text-slate-800 text-sm">#{{ $ticket->ticket_code }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-md text-slate-800 font-bold mb-2 flex gap-1 items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                            </svg> 
                              Passenger seats:       
                        </p>
                        <p class="text-slate-800 mb-2 text-sm">
                            @foreach ($passenger->tickets->where('flight_id', $flight->id) as $ticket)
                            '{{ $ticket->seat }}'
                            @endforeach
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $passengers->links('livewire::tailwind') }}
        </div>
        
    @else
        <p class="text-center text-gray-600 text-lg">Still no passengers.</p>
    @endif
</div>