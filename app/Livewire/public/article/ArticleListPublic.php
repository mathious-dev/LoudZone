<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class ArticleListPublic extends PublicComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        return $query->paginate(9);
    }
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->tabSearchPossibility=['title'=>'titre'];
        $this->tabSearchAscDescPossibility=[
            'title'=>'titre',
            'price_ht'=>'prix HT'
        ];
    }
}
