<?php

namespace App\Livewire\administration\role;

use App\Livewire\AdminComponent;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Spatie\Permission\Models\Role;

class RoleList extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    protected $model=Role::class;
    public function mount()
    {
        $this->searchWichColumn='name';
        $this->tabSearchPossibility=['name'=>'nom'];
    }
    public function render()
    {
        return view('livewire.administration.role.role-list',['listRoles'=>$this->queryRole()]);
    }
    public function queryRole()
    {
        $query=Role::query();
        $query=$this->searchFunction($query);
        return $query->get();
    }
}
