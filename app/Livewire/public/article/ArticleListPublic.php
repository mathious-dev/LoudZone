<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\CartServices;

class ArticleListPublic extends PublicComponent
{

    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',['listArticles'=>$this->queryArticle(),'listCategories'=>$this->queryCategory()]);
    }
    public function addArticleToCart(CartServices $cartServices,$articleId,$quantity=1)
    {
        $cartServices->AddArticleInCart($articleId,$quantity);
    }
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->searchCategoryWichColumn='article_category_id';
        $this->tabSearchPossibility=['title'=>'Titre'];
        $this->tabSearchAscDescPossibility=[
            'title'=>'Titre',
            'final_price'=>'Prix'
        ];
        $this->tabSearchCategoryPossibility=ArticleCategory::pluck('label','id');
    }
    public function queryArticle()
    {
        $query=Article::query();
        $query=$query->where('is_published',true);
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        $query=$this->searchCategoryFunction($query);
        return $query->paginate(9);
    }
    public function queryCategory()
    {
        $query=ArticleCategory::query();
        return $query->get();
    }
}
