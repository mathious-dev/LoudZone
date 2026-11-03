<?php
namespace App\Livewire\administration\user;
use App\Livewire\AdminComponent;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserList extends AdminComponent
{
    protected $model=User::class;
    public $tabWithRelations=[];
    public function mount()
    {
        $this->searchWichColumn = 'name';
        $this->searchAscDescWichColumn = 'name';
        $this->searchBooleanWichColumn='news_letter';
        $this->tabSearchPossibility=[
            'name'=>'Nom',
            'first_name'=>'Prénom',
            'email'=>'Adresse mail',
            'id'=>'Id'];
        $this->tabSearchAscDescPossibility=[
            'name'=>'Nom',
            'first_name'=>'Prénom',
            'email'=>'Adresse mail',
        ];
        if(request()->query('roleId'))
            $this->searchRole=request()->query('roleId');
        $this->tabWithRelations=['roles'];
    }
    public function render()
    {
        return view('livewire.administration.user.user-list',['listUsers'=>$this->query(10,$this->tabWithRelations),
        'listSearch'=>$this->querySearch(),
        'listRoles'=>$this->otherQuery(Role::class)]);
    }
}
