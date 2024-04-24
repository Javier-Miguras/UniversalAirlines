<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Flight') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl font-bold text-center text-gray-700 mt-8 mb-4">Edit flight</h1>
                <div class="md:flex md:justify-center p-5">
                    <livewire:edit-flight
                        :flight="$flight"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
