<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;

class ArticleListPublic extends PublicComponent
{

    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',['listArticles'=>$this->queryArticle()]);
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
    public function queryArticle()
    {
        $query=Article::query();
        $query=$query->where('is_published',true);
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        return $query->paginate(9);
    }
}
