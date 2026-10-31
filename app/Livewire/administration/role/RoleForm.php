<?php

namespace App\Livewire\administration\role;

use App\Livewire\AdminComponent;
use App\Traits\CrudTrait;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends AdminComponent
{
    use CrudTrait;
    public $role;
    public $name;
    public $listPermissions=[];
    public $listPermissionsChoice=[];
    public function render()
    {
        return view('livewire.administration.role.role-form');
    }
    public function mount(Role $role=null)
    {
        if($role&&$role->exists)
        {
            $this->role=$role;
            $this->fill($role->toArray());
            $this->listPermissionsChoice=$this->role->permissions->pluck('id')->toArray();
            $this->isEditing=true;
        }
        else
        {
            $this->role=new Role();
            $this->isEditing=false;
        }
        $this->listPermissions=Permission::pluck('name','id');
    }
    public function rules()
    {
        return ['name'=>'required|string|max:255'];
    }
    public function saveForm()
    {
        $data=$this->validate();
        $data['guard_name']='web';
        $permissionsIds = array_map('intval', $this->listPermissionsChoice);
        $this->savePermissionAndRole($this->role,$data,"syncPermissions",$permissionsIds,"admin.roleList");
    }
    
}
