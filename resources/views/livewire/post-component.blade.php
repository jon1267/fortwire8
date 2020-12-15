<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Posts content</h2>
</x-slot>

<div class="mx-w-7xl">
    <!-- -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                @include('layouts.status-block')

                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Добавить пост</button>

                @if($isModal)
                    @include('livewire.post-create')
                @endif

                <!--<table class="table-fixed w-full">-->
                <table class="w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">ID</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Text</th>
                        <th class="px-4 py-2">Picture</th>
                        <th class="px-4 py-2" style="width: 150px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $row->id }}</td>
                            <td class="border px-4 py-2">{{ $row->title }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($row->body) }}</td>
                            <td class="border px-4 py-2">
                                <!--<img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">-->
                                @if($row->img)
                                    <img src="{{ asset('img/'. $row->img) }}" class="h-15 w-16" alt="">
                                @endif
                            </td>
                            {{--<td class="border px-4 py-2">{{ $row->created_at }}</td>--}}
                            <td class="border px-4 py-2">
                                <button wire:click="update({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 rounded" title="Редактировать данные"><i class="fas fa-pen"></i></button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold px-3 py-2 rounded" title="Удалить данные"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">Нет данных</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    @if($posts->hasPages())
                        {{ $posts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- -->
</div>
