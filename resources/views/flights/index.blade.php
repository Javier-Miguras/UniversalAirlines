<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(session()->has('message'))
                    <div class="border-green-600 border-2 mt-1 bg-green-100 text-green-600 font-semibold p-2 text-sm">
                        {{ session('message') }}
                    </div>
                @endif

                @if(auth()->user()->rol === 1)
                    <div class="pb-6 text-gray-900">
                        <livewire:list-flights-admin />
                    </div>
                @else
                    <div>
                        <x-list-tickets />
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
