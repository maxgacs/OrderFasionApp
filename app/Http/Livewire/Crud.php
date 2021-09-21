<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Crud extends Component
{
    public $users,$name, $username, $email,$user_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->username = '';
        $this->email = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);
    
        User::updateOrCreate(['userID' => $this->user_id], [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        session()->flash('message', $this->user_id ? 'User updated.' : 'User created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userID = $id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted.');
    }
}
