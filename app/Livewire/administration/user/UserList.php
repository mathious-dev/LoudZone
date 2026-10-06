<?php
namespace App\Livewire\administration\user;
use App\Livewire\AdminComponent;
use App\Models\User;
use App\Traits\CrudTrait;
use Livewire\WithPagination;
class UserList extends AdminComponent
{
    protected $model=User::class;
    use CrudTrait;
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
