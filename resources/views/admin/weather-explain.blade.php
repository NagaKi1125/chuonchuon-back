<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weather Element Explanation') }}
        </h2>
    </x-slot>
    {{-- <div class="btn-checked"><a href="#addnewexpl" class="btn btn-success">Add new Explanation</a></div> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Checked</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Unchecked</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card-columns">
                                    @foreach ($checked as $check)
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="header-title" style="margin:1%;">{{ $check->type }}</h4>
                                            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#description{{ $check->_id }}" role="tab"
                                                        aria-controls="description{{ $check->_id }}" aria-selected="true">Description</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  href="#history{{ $check->_id }}" role="tab"
                                                        aria-controls="history{{ $check->_id }}" aria-selected="false">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane active" id="description{{ $check->_id }}" role="tabpanel">
                                                    <p class="card-text">{{ $check->explanation }}</p>
                                                </div>

                                                <div class="tab-pane" id="history{{ $check->_id }}" role="tabpanel" aria-labelledby="history{{ $check->_id }}">
                                                    <form method="POST" action="{{ route('explain.edit', [$check->id,Auth::user()->_id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <x-label for="type" :value="__('Type of weather elements')" />
                                                            <input id="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            type="text" name="type" value="{{ $check->type }}" required autofocus />
                                                        </div>

                                                        <div>
                                                            <x-label for="explanation" :value="__('Explanation')" />
                                                            <textarea id="explanation" rows="6" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            type="text" name="explanation" required autofocus>{{ $check->explanation }}</textarea>
                                                        </div>

                                                        <div class="flex items-center justify-end mt-4">
                                                            <x-button class="ml-3 btn-sm">
                                                                {{ __('Update') }}
                                                            </x-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <form method="POST" action="{{ route('explain.delete',[$check->_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-outline-warning" href="{{ route('explain.un_checked',[$check->_id]) }}">Uncheck this explanation</a>
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>



                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card-columns">
                                    @foreach ($unchecked as $un)
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="header-title" style="margin:1%;">{{ $un->type }}</h4>
                                            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#description{{ $un->_id }}" role="tab"
                                                        aria-controls="description{{ $un->_id }}" aria-selected="true">Description</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  href="#history{{ $un->_id }}" role="tab"
                                                        aria-controls="history{{ $un->_id }}" aria-selected="false">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane active" id="description{{ $un->_id }}" role="tabpanel">
                                                    <p class="card-text">{{ $un->explanation }}</p>
                                                </div>

                                                <div class="tab-pane" id="history{{ $un->_id }}" role="tabpanel" aria-labelledby="history{{ $un->_id }}">
                                                    <form method="POST" action="{{ route('explain.edit', [$un->id,Auth::user()->_id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <x-label for="type" :value="__('Type of weather elements')" />
                                                            <input id="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            type="text" name="type" value="{{ $un->type }}" required autofocus />
                                                        </div>

                                                        <div>
                                                            <x-label for="explanation" :value="__('Explanation')" />
                                                            <textarea id="explanation" rows="6" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            type="text" name="explanation" required autofocus>{{ $un->explanation }}</textarea>
                                                        </div>

                                                        <div class="flex items-center justify-end mt-4">
                                                            <x-button class="ml-3 btn-sm">
                                                                {{ __('Update') }}
                                                            </x-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <form method="POST" action="{{ route('explain.delete',[$un->_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-outline-success" href="{{ route('explain.checked',[$un->_id]) }}">Checked</a>
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 addnewexpl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Add new explanation
                    <form method="POST" action="{{ route('explain.store', [Auth::user()->_id]) }}">
                        @csrf

                        <div>
                            <x-label for="type" :value="__('Type of weather elements')" />
                            <x-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus />
                        </div>

                        <div>
                            <x-label for="explanation" :value="__('Explanation')" />
                            <textarea id="explanation" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" name="explanation" :value="old('explanation')" required autofocus></textarea>
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
