<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;
use App\Services\CartService;

class ArticleDetail extends PublicComponent
{
    public $article;
    public $quantity=1;
    public function render()
    {
        return view('livewire.public.article.article-detail');
    }
    public function mount(Article $article)
    {
        if($article)
            $this->article=$article;
    }
    public function addArticleToCart(CartService $CartService,$articleId,$quantity=1)
    {
        $CartService->AddArticleInCart($articleId,$quantity);
    }
    public function addRemoveNumberArticle($number)
    {
        $this->quantity+=$number;
        if($this->quantity<=0)
        {
            $this->quantity=1;
        }
    }
}
