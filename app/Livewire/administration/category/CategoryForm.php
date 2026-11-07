<?php

namespace App\Livewire\administration\category;

use App\Enum\CategoryEnum;
use App\Livewire\AdminComponent;
use App\Models\AddInfo;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryForm extends AdminComponent
{
    public $category;
    public $type;
    public $label;
    public bool $isSupport;
    public $tabAddInfos=[];
    public function render()
    {
        return view('livewire.administration.category.category-form',['listTypeCategories'=>Category::giveListTypeCategory(),
        'listAllAddInfos' => AddInfo::all()]);
    }
    public function mount(Category $category=null)
    {
        if($category)
        {
            $this->category=$category;
            $this->fill($category->toArray());
            $this->tabAddInfos = $category->addInfos->pluck('id')->toArray();
            $this->isEditing=true;
        }
        else
        {
            $this->category=New Category();
            $this->isEditing=false;
        }
        $this->isSupport = ($this->type === CategoryEnum::SUPPORT->value);
        
    }
    public function updatedType($value)
    {
        $this->isSupport = ($value === CategoryEnum::SUPPORT->value);
        if (!$this->isSupport) 
            $this->tabAddInfos = [];
        
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->category,'admin.categoryList');
    }
    public function rules()
    {
        //Pour l'unique on doit préciser la table et aussi dire qu'il faut ignore l'id de l'objet 
        // qu'on est en train de modifier sinon il va détecter l'objet comme un doublon alors qu'on le modifie
        return ['label' => ['required',Rule::unique('categories')->ignore($this->category->id)],
        'type'=>'nullable|max:255'];
    }
}
