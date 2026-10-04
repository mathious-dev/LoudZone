<?php

namespace App\Livewire\administration\role;

use App\Livewire\AdminComponent;
use Spatie\Permission\Models\Role;

class RoleList extends AdminComponent
{
    public function render()
    {
        return view('livewire.administration.role.role-list',['listRoles'=>$this->queryRole()]);
    }
    public function queryRole()
    {
        $query=Role::query();
        return $query->get();
    }
}
