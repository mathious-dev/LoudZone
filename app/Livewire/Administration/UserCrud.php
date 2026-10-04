<?php

namespace App\Livewire\administration;

use App\Livewire\AdminComponent;
use App\Models\User;

use Livewire\WithPagination;

class UserCrud extends AdminComponent
{
    use WithPagination;
    public $userName;
    public $userFirstName;
    public $userEmail;
    public $userNewsLetter;
    public $user;
    
    public function render()
    {
        return view('livewire.administration.user-crud',['listUsers'=>$this->queryUser()]);
    }
    public function mount()
    {

    }
    public function queryUser()
    {
        $query=User::query();
        return $query->paginate(10);
    }
}
