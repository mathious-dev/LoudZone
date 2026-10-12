<?php
namespace App\Livewire\administration\article;
use App\Livewire\AdminComponent;
use App\Models\Article;


class ArticleListAdmin extends AdminComponent
{

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
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->query(10)]);
    }
}
