<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Predict's result management") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-hover table-responsive">
                        <thead class="">
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Result</th>
                                <th scope="col">Image</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                        <tr>
                            <th>{{ $r->user_id }}</th>
                            <td>{{ $r->cloud_code }}</td>
                            <td><img src="{{ secure_asset($r->imge_predict) }}" width="50px"></td>
                            <td>{{ $r->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
