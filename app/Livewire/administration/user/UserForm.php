<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.user-form');
    }
    public function mount(User $user=null)
    {
        if($user&&$user->exists())
            $this->user=$user;
        else
            $this->user=new user();
    }
}
