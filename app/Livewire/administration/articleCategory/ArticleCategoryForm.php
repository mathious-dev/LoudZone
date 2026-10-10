<?php

namespace App\Livewire\administration\articleCategory;

use App\Livewire\AdminComponent;
use App\Models\ArticleCategory;
use App\Traits\CrudTrait;

class ArticleCategoryForm extends AdminComponent
{
    use CrudTrait;
    public $model=ArticleCategory::class;
    public $articleCategory;
    public $label;
    public function mount(ArticleCategory $articleCategory=null)
    {
        if($articleCategory&&!empty($articleCategory))
        {
            $this->articleCategory=$articleCategory;
            $this->fill($articleCategory->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->articleCategory=new ArticleCategory();
            $this->isEditing=false;
        }
    }
    public function render()
    {
        return view('livewire.administration.articleCategory.article-category-form');
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->articleCategory,'admin.articleCategoryList');
    }
    public function rules()
    {
        return ['label'=>'required|max:255'];
    }
}
