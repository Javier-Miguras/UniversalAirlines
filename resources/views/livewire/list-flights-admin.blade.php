<div>
    <div class="md:flex md:justify-between md:gap-10 bg-yellow-300 p-6 md:px-8 md:py-12">
        <div class="md:w-4/12">
            <x-input-label class="mb-2">
                Origin city
            </x-input-label>
            <x-text-input wire:model.live="searchOrigin" class="w-full mb-4 md:mb-0" placeholder="Enter the origin city"/>
        </div>

        <div class="md:w-4/12">
            <x-input-label class="mb-2">
                Destination city
            </x-input-label>
            <x-text-input wire:model.live="searchDestination" class="w-full mb-4 md:mb-0" placeholder="Enter the destination city"/>
    
        </div>
        <x-primary-button  class="w-full md:w-auto" wire:click="$toggle('showFilters')">
            @if ($showFilters) Hide @endif Advanced Search
        </x-primary-button>
    </div>
    <!--Search-->

    <div>
        @if($showFilters)
            <div class="bg-gray-200 p-6 rounded shadow-inner flex relative md:px-8 md:py-12">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input-group inline for="filter-amount-min" label="Minimum Amount">
                        <x-input-money wire:model.lazy="filters.amount-min" id="filter-amount-min" />
                    </x-input-group>

                    <x-input-group inline for="filter-amount-max" label="Maximum Amount">
                        <x-input-money wire:model.lazy="filters.amount-max" id="filter-amount-max" />
                    </x-input-group>
                </div>

                <div class="w-1/2 pl-2 space-y-4">
                    <x-input-group inline for="filter-departure-date" label="Departure date">
                        <input class="w-full" type="date" wire:model.lazy="filters.departure-date" id="filter-departure-date" placeholder="MM/DD/YYYY">
                    </x-input-group>

                    <x-primary-button wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-primary-button>
                </div>
            </div>
        @endif
    </div>
    <!--Advanced search-->

    <div class="mt-8 mb-12 px-6">
        @forelse ($flights as $flight)
            <div class="sm:flex sm:items-center sm:justify-center border border-t-2 border-cyan-600 sm:w-3/4 lg:w-2/3 mx-auto mb-6 shadow-md">
                <div class="sm:w-2/3  sm:border-r  border-cyan-600">
                    <p class="text-sm p-2 bg-cyan-100 text-cyan-600"><span class="font-bold">Date</span> {{$flight->date->format('d-m-Y')}}</p>
                    <div class="flex justify-center items-center gap-6 py-8 px-2">
                        <p class="font-semibold text-gray-800">{{$flight->origin}} - <span class="font-normal">{{$flight->departure_time}}</span></p>
                        <p class="font-semibold text-gray-800">{{$flight->destination}} - <span class="font-normal">{{$flight->arrival_time}}</span></p>
                    </div>
                    <div class="text-center mb-4">
                        <a href="{{ route('flights.passengers', $flight) }}" class="font-semibold text-gray-800 text-xl flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                              </svg>                              
                            {{ count($flight->seats) }} Passengers
                        </a>
                    </div>
                </div>
                <div class="flex flex-row sm:flex-col justify-center gap-8 sm:gap-0 items-center px-2 sm:px-10 sm:w-1/3 border-t border-cyan-600 sm:border-0 py-6 sm:py-0">
                    <p class="font-semibold text-2xl sm:mb-2">${{$flight->price}}</p>
                    <div class="space-y-2">
                        <a href="{{ route('flights.edit', $flight->id) }}" class="bg-amber-400 block text-white py-1 px-4 rounded-sm font-semibold hover:bg-amber-600">Update</a>
                        <button wire:click="$dispatch('showAlert', { flightId: {{ $flight->id }} })" class="bg-rose-500 block w-full text-white py-1 px-4 rounded-sm font-semibold hover:bg-rose-700">
                                Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-xl font-semibold text-gray-800 py-4">
                <p>Oops! It seems there are no flights available for the selected dates and destinations. How about trying other options?</p>
            </div>
        @endforelse
    </div>
    <!--Registers-->

    <div class="px-6 sm:px-8">
        {{ $flights->links('livewire::tailwind') }}
    </div>
</div>

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('showAlert', (flightId) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteFlight', flightId)

                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                }
            });
        });
    </script>
@endpush
