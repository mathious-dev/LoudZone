<?php

namespace App\Livewire\administration\user;

use App\Livewire\AdminComponent;
use App\Models\User;

class UserForm extends AdminComponent
{
    public $user;
    public function render()
    {
        return view('livewire.administration.user.user-form');
    }
    public function mount(User $user=null)
    {
        if($user&&$user->exists)
            $this->user=$user;
        else
            $this->user=new User();
    }
    public function save()
    {
        
    }
}
