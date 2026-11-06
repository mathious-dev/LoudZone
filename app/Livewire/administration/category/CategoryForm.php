<?php

namespace App\Livewire\administration\category;

use App\Livewire\AdminComponent;
use App\Models\Category;

class CategoryForm extends AdminComponent
{
    public $category;
    public $type;
    public $label;
    public function render()
    {
        return view('livewire.administration.category.category-form');
    }
    public function mount(Category $category=null)
    {
        if($category)
        {
            $this->category=$category;
            $this->fill($category->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->category=New Category();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->category,'admin.categoryList');
    }
    public function rules()
    {
        return ['label'=>'required|max:255|unique',
        'type'=>'required|max:255|unique'];
    }
}
