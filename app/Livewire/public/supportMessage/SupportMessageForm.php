<?php

namespace App\Livewire\public\supportMessage;

use App\Livewire\PublicComponent;
use App\Models\Category;
use App\Models\SupportMessage;
use App\Traits\CrudTrait;

class SupportMessageForm extends PublicComponent
{
    use CrudTrait;
    public $supportMessage;
    public $title;
    public $content;
    public $category_id;
    public $add_info_id;
    public $listAddInfos=[];
    public $previousUrl;
    public function render()
    {
        return view('livewire.public.supportMessage.support-message-form',['listCategories'=>SupportMessage::getCategoryForSupportMessage()]);
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
        'category_id'=>'required',
        'add_info_id' => 'nullable'];
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
        if (!empty($this->category_id)) 
            $this->listAddInfos = Category::find($this->category_id)->addInfos;
        else 
            $this->listAddInfos = [];
    }
}
