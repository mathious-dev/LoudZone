<?php

namespace App\Livewire\administration\SupportMessageCategory;

use App\Livewire\AdminComponent;
use App\Models\SupportMessageCategory;


class SupportMessageCategoryForm extends AdminComponent
{
    public $supportMessageCategory;
    public $label;
    public function render()
    {
        return view('livewire.administration.supportMessageCategory.support-message-category-form');
    }
    public function mount(SupportMessageCategory $supportMessageCategory=null)
    {
        if($supportMessageCategory&&!empty($supportMessageCategory))
        {
            $this->supportMessageCategory=$supportMessageCategory;
            $this->fill($supportMessageCategory->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->supportMessageCategory=new SupportMessageCategory();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->supportMessageCategory,'admin.supportMessageCategoryList');
    }
    public function rules()
    {
        return ['label'=>'required|max:255'];
    }
}
