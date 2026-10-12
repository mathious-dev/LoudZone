<?php
namespace App\Livewire\administration\user;
use App\Livewire\AdminComponent;
use App\Models\User;
class UserList extends AdminComponent
{

    protected $model=User::class;
    public function mount()
    {
        $this->searchWichColumn = 'name';
        $this->searchAscDescWichColumn = 'name';
        $this->tabSearchPossibility=[
            'name'=>'Nom',
            'first_name'=>'Prénom',
            'email'=>'Adresse mail'];
        $this->tabSearchAscDescPossibility=[
            'name'=>'Nom',
            'first_name'=>'Prénom',
            'email'=>'Adresse mail',
        ];
    }
    public function render()
    {
        return view('livewire.administration.user.user-list',['listUsers'=>$this->query(10)]);
    }
}
