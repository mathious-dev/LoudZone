<?php

namespace App\Livewire\administration\role;

use App\Livewire\AdminComponent;
use App\Traits\CrudTrait;
use Spatie\Permission\Models\Role;

class RoleForm extends AdminComponent
{
    use CrudTrait;
    public $role;
    public $name;
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
            $this->isEditing=true;
        }
        else
        {
            $this->role=new Role();
            $this->isEditing=false;
        }
    }
    public function rules()
    {
        return ['name'=>'required|string|max:255'];
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->role,"admin.roleList");
    }
    
}
