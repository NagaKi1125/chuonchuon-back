<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Homepage management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    {{--  <p>Please click the button below to get your current position</p>
                    <a class="btn btn-primary" onclick="geoFindMe();">Get my position</a>
                    <div>
                        <p id="success"></p>
                        <p id="lat-local"></p>
                        <p id="lon-local"></p>
                        <p id="error"></p>
                    </div>

                    <form method="POST" action= {{ route('user.location') }}>
                        @csrf
                        <div class='container text-center'>
                            <div class="row">
                                <div class="col-md">
                                    <x-label for="lat" :value="__('lat')" />

                                    <x-input id="lat" class="block mt-1 w-full" type="lat" name="lat" :value="old('lat')" required autofocus />
                                </div>
                                <div class="col-md">
                                    <x-label for="lon" :value="__('lon')" />

                                    <x-input id="lon" class="block mt-1 w-full" type="lon" name="lon" :value="old('lon')" required autofocus />
                                </div>
                            </div>
                        </div>
                        <x-button class="ml-3">
                            {{ __('Update Location') }}
                        </x-button>
                    </form>  --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
