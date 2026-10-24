<?php

namespace App\Livewire\administration\permission;

use App\Livewire\AdminComponent;
use Spatie\Permission\Models\Permission;

class PermissionForm extends AdminComponent
{
    public $name;
    public $permission;
    protected $model=Permission::class;
    public function render()
    {
        return view('livewire.administration.permission.permission-form');
    }
    public function mount(Permission $permission=null)
    {
        if($permission&&$permission->exists)
        {
            $this->permission=$permission;
            $this->fill($permission->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->permission=new Permission();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->permission,'admin.permissionList');
    }
    public function rules()
    {
        return ['name'=>'max:255|required'];
    }
}
