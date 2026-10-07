<?php
namespace App\Livewire\administration\article;
use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class ArticleListAdmin extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    protected $model=Article::class;
    public $search='';
    public function render()
    {
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        $query=$this->search($this->search,$query,'title');
        return $query->paginate(10);
    }
}
