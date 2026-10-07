<?php

namespace App\Livewire\public\article;

use App\Models\Article;
use App\Traits\CrudTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleListPublic extends Component
{
    use CrudTrait;
    use WithPagination;
    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        return $query->paginate(9);
    }
}
