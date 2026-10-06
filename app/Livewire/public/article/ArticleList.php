<?php

namespace App\Livewire\public\article;

use App\Models\Article;
use App\Traits\deleteTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use deleteTrait;
    use WithPagination;
    public function render()
    {
        return view('livewire.public.article.article-list',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        return $query->paginate(10);
    }
}
