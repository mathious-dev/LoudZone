<?php

namespace App\Livewire\administration\permission;

use App\Livewire\AdminComponent;
use Spatie\Permission\Models\Permission;

class PermissionList extends AdminComponent
{
    protected $model=Permission::class;
    public function render()
    {
        return view('livewire.administration.permission.permission-list',['listPermissions'=>$this->query()]);
    }
}
