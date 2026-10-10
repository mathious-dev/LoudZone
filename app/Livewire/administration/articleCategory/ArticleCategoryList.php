<?php

namespace App\Livewire\administration\articleCategory;

use App\Livewire\AdminComponent;
use App\Models\ArticleCategory;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class ArticleCategoryList extends AdminComponent
{
    public $model=ArticleCategory::class;
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    public function render()
    {
        return view('livewire.administration.articleCategory.article-category-list',['listArticleCategories'=>$this->queryArticleCategory()]);
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
    public function queryArticleCategory()
    {
        $query=ArticleCategory::query();
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        return $query->paginate(10);
    }
}
