<!-- это еще вариант самоисчезающих flash notify для работы нужно Alpine JS (в главн. шаблоне естеств) -->
<!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> -->

@if (session()->has('message'))
    <!-- This is an example component -->
    <div x-data="{show: true}" x-show="show"  x-on:click="show = false" x-init="setTimeout(()=> show = false, 2500)"
         class="absolute right-0 top-0 m-5 "
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-1000"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
    >
        <!--<div class="absolute right-0 top-0 m-5 ">-->
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
        <!--</div>-->
    </div>
    {{--<div x-data="{show: true}" x-show="show"  x-on:click="show = false" x-init="setTimeout(()=> show = false, 3000)"
         class="absolute right-0 top-0 m-5"
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-1000"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
    >
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
@endif
