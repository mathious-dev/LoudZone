<?php

namespace App\Livewire\administration\user;

use App\Livewire\AdminComponent;
use App\Models\User;

use App\Traits\deleteTrait;
use Livewire\WithPagination;

class UserList extends AdminComponent
{
    protected $model=User::class;
    use deleteTrait;
    use WithPagination;
    public function render()
    {
        return view('livewire.administration.user.user-list',['listUsers'=>$this->queryUser()]);
    }
    public function queryUser()
    {
        $query=User::query();
        return $query->paginate(10);
    }
}
