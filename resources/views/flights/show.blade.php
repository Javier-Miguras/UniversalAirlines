<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 leading-tight text-center md:text-left">
            {{ $flight->origin }} - {{ $flight->destination }} {{ $flight->date->format('d-m-Y') }}
        </h2>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <livewire:flight-booking :flight="$flight" />
        </div>
    </div>
</x-app-layout>