<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
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
                                <form method="POST" action="{{ route('user.delete',[$u->_id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-outline-warning btn-rounded" role="button" data-toggle="collapse" id="heading{{ $u->_id }}"
                                        data-target="#editUser{{ $u->id }}" aria-expanded="false" aria-controls="edit{{ $u->_id }}">
                                        <ion-icon name="create"></ion-icon></a>
                                    <button class="btn btn-sm btn-outline-danger btn-rounded"><ion-icon name="trash"></ion-icon></button>
                                </form>

                            </td>
                        </tr>
                        {{-- edit --}}
                        <tr class="collapse" id="editUser{{ $u->_id }}" aria-labelledby="heading{{ $u->_id }}">
                            <form method="POST" action="{{ route('user.update',[$u->_id]) }}">
                                @csrf
                                @method('PUT')
                                <th scope="row">
                                    <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $u->name }}" required autofocus />
                                </th>
                                <td>
                                    <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $u->email }}" required />
                                </td>

                                <td>
                                    <select class="block mt-1 w-full" required data-live-search="true" id="level" name="level">
                                        @if($u->level == 1)
                                            <option value="1" selected>Adminstrator</option>
                                            <option value="2">User</option>
                                            <option value="0">Tài khoản bị vô hiệu</option>
                                        @elseif($u->level == 2)
                                            <option value="1">Adminstrator</option>
                                            <option value="2" selected>User</option>
                                            <option value="0">Tài khoản bị vô hiệu</option>
                                        @else
                                            <option value="1">Adminstrator</option>
                                            <option value="2">User</option>
                                            <option value="0" selected>Tài khoản bị vô hiệu</option>
                                        @endif
                                </select>
                                </td>

                                <td>
                                    <x-button class="block mt-1">
                                        {{ __('Update') }}
                                    </x-button>
                                </td>

                            </form>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="text-right">{{ $user->links() }}</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
