<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserCrud extends Component
{
    public $userName;
    public $userFirstName;
    public $userEmail;
    public $userNewsLetter;
    public $user;
    public function render()
    {
        return view('livewire.user-crud',['listUsers'=>$this->queryUser()]);
    }
    public function mount()
    {

    }
    public function queryUser()
    {
        $query=User::query();
        return $query;
    }
}
