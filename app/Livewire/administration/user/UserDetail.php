<?php

namespace App\Livewire\administration\user;

use App\Livewire\AdminComponent;
use App\Models\User;

class UserDetail extends AdminComponent
{
    public $user;
    public function render()
    {
        return view('livewire.administration.user.user-detail');
    }
    public function mount($id)
    {
        $this->user = User::with([
            'carts', 
            'orders', 
            'supportMessages', 
            'articles', 
            'roles', 
            'permissions'
        ])->findOrFail($id);
    }
}
