<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;
use App\Models\Category;
use App\Models\Event;
use App\Services\CartService;

class ArticleListPublic extends PublicComponent
{
    protected $model=Article::class;
    public function render()
    {
        return view('livewire.public.article.article-list-public',
        ['listArticles'=>$this->queryArticle(['promotion','category','clothes']),
        'listCategories'=>$this->otherQuery(Category::class),
        'listSearch'=>$this->querySearch(),
        'importantEvent'=>$this->queryEvent()]);
    }
    public function addArticleToCart(CartService $CartService,$articleId,$quantity=1)
    {
        $CartService->AddArticleInCart($articleId,$quantity);
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
        $this->tabSearchCategoryPossibility=Category::pluck('label','id');
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
