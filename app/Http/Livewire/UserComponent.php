<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $user_id;
    public $isModal;
    public $checkedRoles;

    public function render()
    {
        $users = User::get();
        $roles = Role::all();
        return view('livewire.user-component', [
            'users' => $users,
            'roles' => $roles,
        ]);
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
        $this->password_confirmation = '';
        $this->checkedRoles = [];
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function update($id)
    {
        $user = User::find($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';

        $this->openModal();
    }

    public function store()
    {
        // dd($this);
        $this->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|between:8,25|confirmed',
            'checkedRoles' => "required|array|min:1",
        ]);

        $user = User::updateOrcreate(
            ['id' => $this->user_id],
            [
                'name' => $this->name,
                'email'=> $this->email,
                'password' => $this->password
            ]
        );

        $user->roles()->sync($this->checkedRoles);

        session()->flash('message', 'Данные пользователя сохранены.');
        $this->closeModal();
        $this->resetFields();
    }

    public function delete($id)
    {

    }
}
