<x-app-layout>
    @if(session()->has('message'))
                    <div class="border-red-600 border-2 mt-1 bg-red-100 text-red-600 font-semibold p-2 text-sm">
                        {{ session('message') }}
                    </div>
                @endif
    <div class="bg-home-image bg-cover bg-center bg-no-repeat h-dvh lg:h-96 flex flex-col justify-center items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-bold text-5xl text-center drop-shadow-[0_10px_20px_rgba(74,4,78,0.60)] text-white mb-4">Fly Beyond with Universal Airlines</h1>
            <h3 class="font-semibold text-center text-3xl text-rose-400">Experience Seamless Journeys to Every Destination</h3>
        </div>
    </div>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 pb-10">
        <h1 class="text-slate-700 text-4xl font-bold text-center my-6">Search for flights!</h1>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="pb-6 text-gray-900">
                <livewire:list-flights />
            </div>
        </div>
    </div>
</x-app-layout>