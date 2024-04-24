<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
    <h1 class="text-2xl font-bold text-center text-gray-700 mt-6 mb-4">Flight Information</h1>
    <div class="md:flex md:justify-around md:gap-4 p-6 space-y-4 md:space-y-0 bg-gray-100">
        <div class="space-y-4">
            <p><span class="font-semibold">Flight origin: </span>{{ $flight->origin }} {{$flight->departure_time}}</p>
            <p><span class="font-semibold">Flight destination: </span>{{ $flight->destination }} {{$flight->arrival_time}}</p>
        </div>
        <div class="space-y-4">
            <p><span class="font-semibold">Departure terminal: </span>{{ $flight->departure_terminal }}</p>
            <p><span class="font-semibold">Arrival terminal: </span>{{$flight->arrival_terminal}}</p>
        </div>
    </div>
    <div class="md:flex md:justify-center md:items-center md:gap-8 p-6 @if(!$showSeats)mb-2 @endif">
        <p class="font-semibold text-center mb-4 md:mb-0">Price: <span class="bg-yellow-400 text-white py-1 px-2 rounded-md">${{ $flight->price }} per ticket</span></p>
        <p class="flex gap-1 justify-center mb-4 md:mb-0">
            <span class="flex font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-armchair" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 11a2 2 0 0 1 2 2v2h10v-2a2 2 0 1 1 4 0v4a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                    <path d="M5 11v-5a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v5" />
                    <path d="M6 19v2" />
                    <path d="M18 19v2" />
                  </svg>
                Disponible Seats: 
            </span>
            {{ $flight->available_seats }}
        </p>
        <div>
            <button 
            wire:click="$toggle('showSeats')" @if(!$showSeats) class="w-full md:w-auto bg-emerald-400 hover:bg-emerald-600 flex gap-1 text-white py-1 px-4 rounded-sm font-semibold justify-center items-center" @else class="w-full md:w-auto bg-slate-600 hover:bg-slate-700 flex gap-1 text-white py-1 px-4 rounded-sm font-semibold justify-center items-center" @endif>
                Select your seats
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
                  
            </button>
        </div>
    </div>
    <div>
        @if($showSeats)
            <div class="md:flex md:justify-around p-4 md:p-8 mb-6">
                <div class="md:w-1/3 mb-10 md:mb-0 sticky">
                    <p class="mb-4 text-gray-700">Select one or more seats to proceed to checkout. Pink-colored seats are still available, while gray-colored ones have already been reserved and cannot be selected.</p>
                    @foreach ($selectedSeats as $seat)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 font-semibold">Seat number {{ $seat }}:</p>
                            </div>
                            <div>
                                <p class="text-slate-400 font-semibold">${{ $flight->price }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        @if(count($selectedSeats) > 0)
                            <div class="flex justify-between items-center border-t-2 border-red-600 text-red-600 mt-2 font-semibold text-xl">
                                <div>
                                    <p>Total:</p>
                                </div>
                                <div>
                                    <p>${{ $flight->price * count($selectedSeats) }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <form action="{{ route('paypal') }}" method="POST">
                            @csrf
                            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                            <input type="hidden" name="quantity" value="{{ count($selectedSeats) }}">   
                            <input type="hidden" name="seats" value="{{ json_encode($selectedSeats) }}">   
                            <input type="hidden" name="amount" value="{{ $flight->price * count($selectedSeats) }}">   

                            <button @if(count($selectedSeats) > 0 && auth()->user()->rol != 1 && auth()->user()->email_verified_at != null) type="submit" class="hover:bg-green-700 bg-green-500 shadow-md border border-gray-400 rounded-md text-base py-1 px-2 font-semibold text-white flex items-center gap-1 justify-center mt-6" @else disabled class="hover:bg-gray-100 bg-white shadow-md border border-gray-400 rounded-md text-base py-1 px-2 font-semibold text-gray-600 flex items-center gap-1 justify-center mt-6 pointer-events-none" @endif >
                                @if(auth()->user()->rol == 1)
                                    Admins can't buy tickets.
                                @elseif(auth()->user()->email_verified_at == null)
                                    Verify account to continue.
                                @else
                                    Go to Checkout
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-7 w-60 mx-auto md:mx-0 border-t border-l border-r border-gray-500 rounded-tl-full rounded-tr-full px-2">
                    <div class="col-span-7 h-28"></div>
                    @php
                        $column = 1;
                    @endphp
                    @for ($i = 1; $i <= $flight->total_seats; $i++)
                        @if ($flight->seats->pluck('seat')->contains($i))
                            <div class="text-xs font-semibold bg-slate-300 text-white p-0.5 m-0.5 flex justify-center items-center rounded-full hover:cursor-not-allowed w-7 h-7"></div>
                        @else
                            <div wire:click="toggleSeatSelection({{ $i }})" @if(in_array($i, $selectedSeats)) class="text-xs font-semibold bg-pink-300 text-white p-0.5 m-0.5 flex justify-center items-center rounded-full hover:cursor-pointer w-7 h-7" @else class="text-xs font-semibold bg-pink-500 text-white p-0.5 m-0.5 flex justify-center items-center rounded-full hover:cursor-pointer w-7 h-7" @endif></div>
                        @endif
                        
                        @if ($column == 3)
                            <div></div>
                        @endif
                        @php
                            $column++;
                            if ($column > 7) {
                                $column = 2; // Reinicia la columna al inicio de la fila
                            }
                        @endphp
                    @endfor
                </div>
            </div>
        @endif
    </div>
</div>
