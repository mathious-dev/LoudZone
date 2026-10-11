<?php

namespace App\Livewire\administration\addInfo;

use App\Livewire\AdminComponent;
use App\Models\AddInfo;
use App\Traits\CrudTrait;

class AddInfoForm extends AdminComponent
{
    use CrudTrait;
    public $addInfo;
    public $label;
    public function render()
    {
        return view('livewire.administration.addInfo.add-info-form');
    }
    public function mount(AddInfo $addInfo=null)
    {
        if($addInfo&&!empty($addInfo))
        {
            $this->addInfo=$addInfo;
            $this->fill($addInfo->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->addInfo=new AddInfo();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->addInfo,'admin.addInfoList');
    }
    public function rules()
    {
        return ['label'=>'required|max:255'];
    }
}
