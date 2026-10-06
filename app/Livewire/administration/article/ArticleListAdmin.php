<?php
namespace App\Livewire\administration\article;
use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Traits\CrudTrait;
use Livewire\WithPagination;
class ArticleListAdmin extends AdminComponent
{
    use CrudTrait;
    use WithPagination;
    public function render()
    {
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        return $query->paginate(10);
    }
}
