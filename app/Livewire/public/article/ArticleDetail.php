<?php

namespace App\Livewire\public\article;

use App\Livewire\PublicComponent;
use App\Models\Article;

class ArticleDetail extends PublicComponent
{
    public $article;
    public function render()
    {
        return view('livewire.public.article.article-detail');
    }
    public function mount(Article $article)
    {
        if($article)
            $this->article=$article;
    }
}
