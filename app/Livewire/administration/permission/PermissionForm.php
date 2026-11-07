<?php

namespace App\Livewire\administration\permission;

use App\Livewire\AdminComponent;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
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
        $data=$this->validate();
        $data['guard_name']='web';
        $this->save($data,$this->permission,'admin.permissionList');
    }
    public function rules()
    {
        return ['name' => ['required', 'max:255', Rule::unique('permissions', 'name')->ignore($this->permission->id)]];
    }
}
