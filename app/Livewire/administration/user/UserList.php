<?php
namespace App\Livewire\administration\user;
use App\Livewire\AdminComponent;
use App\Models\User;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;
class UserList extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    protected $model=User::class;
    public $search='';
    public $searchWichColumn = 'name';
    public $tabSearchPossibility=[
        'name'=>'Nom',
        'first_name'=>'Prénom',
        'email'=>'Adresse mail'];
    public function render()
    {
        return view('livewire.administration.user.user-list',['listUsers'=>$this->queryUser()]);
    }
    public function queryUser()
    {
        $query=User::query();
        $query=$this->search($this->search,$query,$this->searchWichColumn);
        return $query->paginate(10);
    }
}
