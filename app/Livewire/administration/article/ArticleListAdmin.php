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
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->tabSearchPossibility=[
            'title'=>'titre',
            'slug'=>'lien'
        ];
        $this->tabSearchAscDescPossibility=[
            'title'=>'titre',
            'slug'=>'lien',
            'price_ht'=>'prix HT'
        ];
    }
    public function render()
    {
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->queryArticle()]);
    }
    public function queryArticle()
    {
        $query=Article::query();
        $query=$this->search($query);
        $query=$this->searchAscDesc($query);
        return $query->paginate(10);
    }
}
