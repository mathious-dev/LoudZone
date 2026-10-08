<?php

namespace App\Livewire\public\article;

use App\Models\Article;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleListPublic extends Component
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
        $query=$this->search($query);
        return $query->paginate(9);
    }
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->tabSearchPossibility=['title'=>'titre'];
    }
}
