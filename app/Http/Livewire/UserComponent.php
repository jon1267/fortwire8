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
    public $updateMode = false;
    public $isConfirmDelete = false;

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
        $this->updateMode = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
        $this->resetValidation();

    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->updateMode = true;

        //курить редактирование юзера с уже имеющимися ролями...:)
        //и редактир. пароля (не ввели, значит не меняеть, см в store validate)

        //$this->checkedRoles = $user->roles->pluck('id')->toArray();
        $this->checkedRoles  = [];

        $this->openModal();
    }

    public function store()
    {
        //dd($this);
        $this->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user_id,
            'password' => (!$this->updateMode) ?
                'required|between:8,25|confirmed' :
                'nullable|between:8,25|confirmed' ,
            'checkedRoles' => "required|array|min:1",
        ]);

        $data = [
            'name' => $this->name,
            'email'=> $this->email,
        ];

        /*if  (isset($this->password) && !empty($this->password)) {
           $data['password'] = $this->password;
        } говорят кодить с if() некошерно..) - заменил ?? и array_filter() */
        
        $data['password'] = $this->password ?? null;
        //удаляем из массива $data null. если при корректировке не ввели пароль,
        //тогда останется старый. но если стали вводить, пароль меняется.
        //dd(array_filter($data));

        $user = User::updateOrcreate(['id' => $this->user_id], array_filter($data));

        $user->roles()->sync($this->checkedRoles);

        session()->flash('message', 'Данные успешно сохранены.');
        $this->closeModal();
        $this->resetFields();
    }

    public function confirmDelete($id)
    {
        $this->isConfirmDelete = $id;
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $this->isConfirmDelete = false;

        session()->flash('message', 'Данные успешно удалены.');
    }
}
