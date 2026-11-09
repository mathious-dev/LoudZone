<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;
use App\Models\Event;
use App\Models\PriceFilter;
use App\Services\CartService;

class ArticleListPublic extends PublicComponent
{
    public $tabListPriceFilterId=[];
    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',
        ['listArticles'=>$this->queryArticle(['promotion','category','clothes']),
        'listCategories'=>Article::getCategoryForArticle(),
        'listSearch'=>$this->querySearch(),
        'importantEvent'=>$this->queryEvent(),
        'listPriceFilters'=>PriceFilter::where('is_active',true)->get()]);
    }
    public function addArticleToCart(CartService $CartService,$articleId,$quantity=1)
    {
        $CartService->AddArticleInCart($articleId,$quantity);
    }
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->searchCategoryWichColumn='category_id';
        $this->tabSearchPossibility=['title'=>'Titre'];
        $this->tabSearchAscDescPossibility=[
            'title'=>'Titre',
            'final_price'=>'Prix'
        ];
        $this->tabSearchCategoryPossibility=Article::getCategoryForArticle();
    }
    public function queryArticle($withRelations=[])
    {
        $query=Article::query();
        if($withRelations)
            $query=$query->with($withRelations);
        $query=$query->where('is_published',true);
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        $query=$this->searchCategoryFunction($query);
        return $query->paginate(9);
    }
    public function queryEvent()
    {
        $query=Event::query();
        return $query->where('is_important',true)->first();
    }
}
