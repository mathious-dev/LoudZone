<?php

namespace App\Livewire\public\supportMessage;

use App\Livewire\PublicComponent;
use App\Models\SupportMessage;
use App\Models\SupportMessageCategory;
use App\Traits\CrudTrait;

class SupportMessageForm extends PublicComponent
{
    use CrudTrait;
    public $supportMessage;
    public $title;
    public $content;
    public $support_message_category_id;
    public $add_info_id;
    public $listAddInfos=[];
    public $previousUrl;
    public function render()
    {
        return view('livewire.public.supportMessage.support-message-form',['listCategories'=>$this->querySupportMessageCategory()]);
    }
    public function mount()
    {
        $this->supportMessage=new SupportMessage();
        $this->previousUrl=url()->previous();
    }
    public function rules()
    {
        return['title'=>'max:255',
        'content'=>'required|max:255',
        'support_message_category_id'=>'required',
        'add_info_id' => 'nullable'];
    }
    public function querySupportMessageCategory()
    {
        $query=SupportMessageCategory::query();
        return $query->get();
    }
    public function saveForm()
    {
        $data=$this->validate();
        $data['user_id']=auth()->id();
        $this->save($data,$this->supportMessage,$this->previousUrl);
    }
    public function updatedSupportMessageCategoryId()
    {
        $this->add_info_id = null;
        if (!empty($this->support_message_category_id)) 
            $this->listAddInfos = SupportMessageCategory::find($this->support_message_category_id)->addInfos;
        else 
            $this->listAddInfos = [];
    }
}
