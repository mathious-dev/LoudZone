<?php

namespace App\Livewire\administration;

use App\Livewire\AdminComponent;
use Spatie\Permission\Models\Role;

class RoleCrud extends AdminComponent
{
    public function render()
    {
        return view('livewire.administration.role-crud',['listRoles'=>$this->queryRole()]);
    }
    public function queryRole()
    {
        $query=Role::query();
        return $query->get();
    }
}
