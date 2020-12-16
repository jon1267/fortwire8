<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Users Management</h2>
</x-slot>

<div class="mx-w-7xl">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                @include('layouts.status-block')
                @if($isModal)
                    @include('livewire.user-create')
                @endif

                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                    <i class="fas fa-user-plus pr-2"></i> Добавить пользователя
                </button>

                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Name
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Email
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Roles
                        </th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Name</span>
                            {{ $user->name }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
                            {{ $user->email }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            @if(count($user->roles))
                                @foreach($user->roles as $role)
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Roles</span>
                                    <span
                                        class="rounded @if($role->name === 'Admin') bg-red-400 @elseif($role->name === 'Manager') bg-blue-400 @else bg-green-400 @endif py-1 px-3 mx-1 text-xs font-bold">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            @endif
                            {{-- это перечислит все роли юзера через зпт. --}}
                            {{-- <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td> --}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                            <button wire:click="update({{ $user->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 rounded" title="Редактировать данные"><i class="fas fa-pen"></i></button>
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold px-3 py-2 rounded" title="Удалить данные"><i class="fas fa-trash-alt"></i></button>

                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="4">Нет данных</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

