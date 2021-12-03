<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cloud Add ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><b>Add new cloud type information</b></p>
                    <form method="POST" action="{{ route('cloud.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-label for="cloud_code" :value="__('Cloud code')" />
                            <x-input id="cloud_code" class="block mt-1 w-full" type="text" name="cloud_code" :value="old('cloud_code')" required autofocus />
                        </div>

                        <div>
                            <x-label for="cloud_name" :value="__('Cloud name')" />
                            <x-input id="cloud_name" class="block mt-1 w-full" type="text" name="cloud_name" :value="old('cloud_name')" required autofocus />
                        </div>

                        <div>
                            <x-label for="structure" :value="__('Structure of cloud')" />
                            <textarea id="structure" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" name="structure" :value="old('structure')" required autofocus></textarea>
                        </div>

                        <div>
                            <x-label for="weather" :value="__('The weather its may happen')" />
                            <textarea id="weather" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" name="weather" :value="old('weather')" required autofocus></textarea>
                        </div>

                        <div>
                            <x-label for="note" :value="__('Note about this type of cloud')" />
                            <textarea id="note" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" name="note" :value="old('note')" required autofocus></textarea>
                        </div>

                        <div>
                            <x-label for="img_thumbnail" :value="__('Choose Image thumbnail')" />
                            <div class ="row">
                                <div class="col-md">
                                    <input id="img_thumbnail" class="block mt-1 w-full" type="file"
                                    name="img_thumbnail" required autofocus onchange="readURL(this)"/>
                                </div>
                                <div class="col-md">
                                    <img class="img_thumbnail" src="" id="imagePreview" width="50%">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3 btn-sm">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
