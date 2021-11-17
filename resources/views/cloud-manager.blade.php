<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cloud type Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-right">
                        <a href="{{ route('cloud.add') }}" class="btn btm-sm btn-outline-success">
                            <ion-icon name="add-circle-outline"></ion-icon>Add Clouds Type
                        </a>
                    </div>
                    <div id="accordion">
                        @foreach ($cloud as $c)
                        {{-- item btn collap trigger --}}
                        <div class="card">
                            <div class="card-header" id="heading{{ $loop->index }}"  data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                                 aria-expanded="false" aria-controls="collapse{{ $loop->index }}" role="button">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="card-title">{{ $c->cloud_name }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $c->cloud_code }}</h6>
                                    </div>
                                    <div class="col text-right">
                                        <form method="POST" action="{{ route('cloud.delete',[$c->_id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            {{-- btn for edit trigger --}}
                                            <a class="btn btn-outline-warning btn-sm" rule="button" data-toggle="collapse" id="heading{{ $c->_id }}"
                                            data-target="#edit{{ $c->_id }}" aria-expanded="false" aria-controls="edit{{ $c->_id }}" href="#edit{{ $c->_id }}">Edit</a>
                                            {{-- btn of delete --}}
                                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{-- div collapse information from database --}}
                            <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                              <div class="row">
                                <div class="col-md-3">
                                    <img class="card-img-top" src="{{ sercure_asset($c->img_thumbnail) }}" alt="Card image cap" width="20%">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $c->cloud_name }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $c->cloud_code }}</h6>
                                        <div class="card-text">
                                            <p class="cloud-weather">{{ $c->weather }}</p>
                                            <b>Structure of clouds</b>
                                            <p class="cloud-structure">{{ $c->structure }}</p>
                                            <b>Note</b>
                                            <p class="cloud-note">{{ $c->note }}</p>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>

                            {{-- div for edit infor --}}
                            <div class="collapse" id="edit{{ $c->_id }}" aria-labelledby="heading{{ $c->_id }}" data-parent="#accordion">
                                <form method="POST" action="{{ route('cloud.edit',[$c->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <x-label for="cloud_code" :value="__('Cloud code')" />
                                        <input id="cloud_code" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" name="cloud_code" value="{{ $c->cloud_code }}" required autofocus />
                                    </div>

                                    <div>
                                        <x-label for="cloud_name" :value="__('Cloud name')" />
                                        <input id="cloud_name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" name="cloud_name" value="{{ $c->cloud_name }}" required autofocus />
                                    </div>

                                    <div>
                                        <x-label for="structure" :value="__('Structure of cloud')" />
                                        <textarea id="structure" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" name="structure" required autofocus>{{ $c->structure }}</textarea>
                                    </div>

                                    <div>
                                        <x-label for="weather" :value="__('The weather its may happen')" />
                                        <textarea id="weather" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" name="weather" required autofocus>{{ $c->weather }}</textarea>
                                    </div>

                                    <div>
                                        <x-label for="note" :value="__('Note about this type of cloud')" />
                                        <textarea id="note" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" name="note" required autofocus>{{ $c->note }}</textarea>
                                    </div>

                                    <div>
                                        <x-label for="img_thumbnail" value="{{ __('Choose Image thumbnail') }}" />
                                        <div class ="row">
                                            <div class="col-md">
                                                <input id="img_thumbnail" class="block mt-1 w-full" type="file"
                                                name="img_thumbnail" autofocus onchange="readURL(this)"/>
                                            </div>
                                            <div class="col-md">
                                                <img class="img_thumbnail" src="{{ sercure_asset($c->img_thumbnail) }}" id="imagePreview" width="50%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="ml-3 btn-sm">
                                            {{ __('Update') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
