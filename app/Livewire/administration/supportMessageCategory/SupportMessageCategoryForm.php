<?php

namespace App\Livewire\administration\SupportMessageCategory;

use App\Livewire\AdminComponent;
use App\Models\AddInfo;
use App\Models\SupportMessageCategory;


class SupportMessageCategoryForm extends AdminComponent
{
    public $supportMessageCategory;
    public $listAddInfos=[];
    public $listAddInfosChoice=[];
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
            //On va allez chercher que les ids
            $this->listAddInfosChoice=$this->supportMessageCategory->addInfos->pluck('id');
            $this->isEditing=true;
        }
        else
        {
            $this->supportMessageCategory=new SupportMessageCategory();
            $this->isEditing=false;
        }
        $this->listAddInfos=AddInfo::pluck('label','id');
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->supportMessageCategory,'admin.supportMessageCategoryList','addInfos',$this->listAddInfosChoice);
    }
    public function rules()
    {
        return ['label'=>'required|max:255'];
    }
}
