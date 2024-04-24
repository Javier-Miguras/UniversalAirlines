<form class="md:w-3/4" wire:submit.prevent='editFlight'>
    <div class="space-y-4 mb-6">
        <div>
            <x-input-label for="date" :value="__('Date')" />
            <x-text-input id="date" class="block mt-1 w-full" type="date" wire:model="date" :value="old('date')" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="origin" :value="__('Origin')" />
            <x-text-input id="origin" class="block mt-1 w-full" wire:model="origin" :value="old('origin')" />
            <x-input-error :messages="$errors->get('origin')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="destination" :value="__('Destination')" />
            <x-text-input id="destination" class="block mt-1 w-full" wire:model="destination" :value="old('destination')" />
            <x-input-error :messages="$errors->get('destination')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" wire:model="price" :value="old('price')" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="departure_time" :value="__('Departure time')" />
            <x-text-input id="departure_time" class="block mt-1 w-full" type="time" wire:model="departure_time" :value="old('departure_time')" />
            <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="arrival_time" :value="__('Arrival time')" />
            <x-text-input id="arrival_time" class="block mt-1 w-full" type="time" wire:model="arrival_time" :value="old('arrival_time')" />
            <x-input-error :messages="$errors->get('arrival_time')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="departure_terminal" :value="__('Departure terminal')" />
            <x-text-input id="departure_terminal" class="block mt-1 w-full" wire:model="departure_terminal" :value="old('departure_terminal')" />
            <x-input-error :messages="$errors->get('departure_terminal')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="arrival_terminal" :value="__('Arrival terminal')" />
            <x-text-input id="arrival_terminal" class="block mt-1 w-full" wire:model="arrival_terminal" :value="old('arrival_terminal')" />
            <x-input-error :messages="$errors->get('arrival_terminal')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="total_seats" :value="__('Total seats')" />
            <x-text-input id="total_seats" class="block mt-1 w-full" type="number" wire:model="total_seats" disabled :value="old('total_seats')" />
            <x-input-error :messages="$errors->get('total_seats')" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end">
        <x-primary-button class="w-full sm:w-auto">
            Save Changes
        </x-primary-button>
    </div>
</form>
