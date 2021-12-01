<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Location updated') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @php

        $mytime = Carbon\Carbon::now()->toDateTimeString();


        @endphp
        {{ $mytime }}
    </div>
</x-app-layout>
