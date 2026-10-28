<?php
namespace App\Livewire\administration\article;
use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Event;
use App\Models\Promotion;


class ArticleListAdmin extends AdminComponent
{
    //Variable pour la colonne de la catégorie d'un article, il faut que ça soit un tableau pour bien séparer les infos de chaque objet
    public $categoryNullInfoId=[];
    public $promotionNullInfoId=[];
    // public $userNullInfoId=[];
    public $listArticleCategories;
    protected $model=Article::class;
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->searchCategoryWichColumn='article_category_id';
        $this->searchBooleanWichColumn='is_published';
        $this->tabSearchPossibility=[
            'title'=>'Titre',
            'slug'=>'Lien'
        ];
        $this->tabSearchAscDescPossibility=[
            'title'=>'Titre',
            'slug'=>'Lien',
            'final_price'=>'Prix final'
        ];
        $this->tabSearchCategoryPossibility=ArticleCategory::pluck('label','id');
        if(request()->query('article_category_id'))
            $this->searchCategory=request()->query('article_category_id');
    }
    public function render()
    {
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->query(10),
        'listCategories'=>$this->queryCategory(),
        'listPromotions'=>$this->queryPromotion(),
        'listSearch'=>$this->querySearch()]);
    }
    public function changeStatePublishArticle(Article $article)
    {
        $article->changeStatePublishArticleModel();
        $stateTexte = $article->is_published ? 'Publié' : 'Dépublié';
        saveHistory("Modification de l'état de l'article : $article->title en $stateTexte");
    }
    public function saveFormCategory(Article $article)
    {
        $this->validate(["categoryNullInfoId.{$article->id}" => 'required']);
        //L'emplacement dans le tableau est l'id de l'article et la valeur est l'id de la catégorie exemple : $categoryNullInfoId[5]=12; 5 = l'article et 12 = la catégorie
        $idCategory=$this->categoryNullInfoId[$article->id];
        $this->saveNullInfo($idCategory,$article,'article_category_id');
    }
    public function queryCategory()
    {
        $query=ArticleCategory::query();
        return $query->get();
    }
    public function queryPromotion()
    {
        $query=Promotion::query();
        return $query->get();
    }
    public function saveFormPromotion(Article $article)
    {
        $this->validate(["promotionNullInfoId.{$article->id}" => 'required']);
        $idPromotion=$this->promotionNullInfoId[$article->id];
        $this->saveNullInfo($idPromotion,$article,'promotion_id');
    }
    
}
