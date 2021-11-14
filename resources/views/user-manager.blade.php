<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <table class="table table-hover table-responsive">
                    <thead class="">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $u )
                        <tr>
                            <th scope="row">
                                <div>
                                    <ion-icon name="person"></ion-icon>{{ $u->name }}
                                </div>

                            </th>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if ($u->level == 1)
                                    Administrator
                                @elseif ($u->level == 0)
                                    Banned
                                @else
                                    User
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-warning btn-rounded"><ion-icon name="create"></ion-icon></a>
                                <a class="btn btn-sm btn-outline-danger btn-rounded"><ion-icon name="trash"></ion-icon></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
