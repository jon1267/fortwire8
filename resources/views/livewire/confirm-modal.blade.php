<!-- Delete User Confirmation Modal -->
<x-jet-dialog-modal wire:model="isConfirmDelete">
        <x-slot name="title">
            {{ __('Удаление !') }}
        </x-slot>

        <x-slot name="content">
            {{-- __('Вы уверены что хотите это удалить ? Операция необратима, восстановление будет не возможно...') --}}
            <p>Вы уверены что хотите это удалить ?</p>
            <p>Операция необратима, восстановление не возможно...</p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('isConfirmDelete',false)" >
                {{ __('Отмена') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete({{ $isConfirmDelete }})" >
                {{ __('Да, Удалить') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

