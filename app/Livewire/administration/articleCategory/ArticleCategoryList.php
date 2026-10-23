<?php

namespace App\Livewire\administration\articleCategory;

use App\Livewire\AdminComponent;
use App\Models\ArticleCategory;

class ArticleCategoryList extends AdminComponent
{
    public $model=ArticleCategory::class;

    public function render()
    {
        return view('livewire.administration.articleCategory.article-category-list',['listArticleCategories'=>$this->query(10),'listSearch'=>$this->querySearch()]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'nom',
        ];
    }
}
