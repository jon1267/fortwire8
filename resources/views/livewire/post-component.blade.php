<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Posts content</h2>
</x-slot>

<div class="py-5">
    <div class="mx-w-7xl">
        <!-- -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div id="status-message">
                    @if (session()->has('message'))
                        <!-- This is an example component -->
                            <div wire:click="hideFlash()" class="absolute right-0 top-0 m-5 cursor-pointer">
                                <div class="m-auto">
                                    <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
                                        <div class="flex flex-row">
                                            <div class="px-2">
                                                <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
                                                </svg>
                                            </div>
                                            <div class="ml-2 mr-6">
                                                <span class="font-semibold">{{ session('message') }}</span>
                                                <!-- <span class="block text-gray-500">Anyone with a link can now view this data</span>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="absolute right-0 top-0 m-5">
                            <!-- Toast Notification Success-->
                                <div class="flex items-center bg-green-500 border-l-4 border-green-700 py-2 px-3 shadow-md mb-2">
                                    <!-- icons -->
                                    <div class="text-green-500 rounded-full bg-white mr-3">
                                        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                        </svg>
                                    </div>
                                    <!-- message -->
                                    <div class="text-white max-w-xs ">
                                        {{ session('message') }}
                                    </div>
                                </div>
                            </div>--}}

                            {{--<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                                <div class="flex">
                                    <div>
                                        <p class="text-sm">{{ session('message') }}</p>
                                    </div>
                                </div>
                            </div>--}}
                        @endif
                    </div>


                    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Добавить пост</button>

                    @if($isModal)
                        @include('livewire.post-create')
                    @endif

                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Text</th>
                            <th class="px-4 py-2">Picture</th>
                            <th class="px-4 py-2 w-20">Created at</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $row)
                            <tr>
                                <td class="border px-4 py-2">{{ $row->title }}</td>
                                <td class="border px-4 py-2">{{ Str::limit($row->body) }}</td>
                                <td class="border px-4 py-2">
                                    <!--<img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">-->
                                    @if($row->img)
                                        <img src="{{ asset('img/'. $row->img) }}" class="h-15 w-16" alt="">
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $row->created_at }}</td>
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
</div>
{{--<script>
window.onload = function(e) {
    let mess =  document.querySelector('.flesh-message');
    console.log(mess);

    setTimeout(function () {

    }, 2500);

};
</script>--}}
