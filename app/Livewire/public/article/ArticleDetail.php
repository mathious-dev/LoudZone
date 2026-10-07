<?php

namespace App\Livewire\public\article;

use App\Models\Article;
use Livewire\Component;

class ArticleDetail extends Component
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
