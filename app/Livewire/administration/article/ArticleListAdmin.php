<?php
namespace App\Livewire\administration\article;
use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Models\ArticleCategory;


class ArticleListAdmin extends AdminComponent
{

    protected $model=Article::class;
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->searchCategoryWichColumn='article_category_id';
        $this->tabSearchPossibility=[
            'title'=>'titre',
            'slug'=>'lien'
        ];
        $this->tabSearchAscDescPossibility=[
            'title'=>'titre',
            'slug'=>'lien',
            'price_ht'=>'prix HT'
        ];
        $this->tabSearchCategoryPossibility=ArticleCategory::pluck('label','id');

        if(request()->query('article_category_id'))
        {
            $this->searchCategory=request()->query('article_category_id');
        }
    }
    public function render()
    {
        return view('livewire.administration.article.article-list-admin',['listArticles'=>$this->query(10)]);
    }
    public function changeStatePublishArticle(Article $article)
    {
        $article->changeStatePublishArticleModel();
        $stateTexte = $article->is_published ? 'Publié' : 'Dépublié';
        saveHistory("Modification de l'état de l'article : $article->title en $stateTexte");
    }
}
