<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $user_id;
    public $isModal;

    public function render()
    {
        $users = User::get();
        return view('livewire.user-component', ['users' => $users]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }
}
