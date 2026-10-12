<?php

namespace App\Livewire\administration\articleOrder;

use App\Livewire\AdminComponent;
use App\Models\ArticleOrder;

class ArticleOrderListAdmin extends AdminComponent
{
    public $model=ArticleOrder::class;
    public function render()
    {
        return view('livewire.administration.articleOrder.article-order-list-admin',['listArticleOrders'=>$this->query()]);
    }
    public function mount()
    {
        $this->searchWichColumn='reference';
        $this->searchAscDescWichColumn = 'total_price';
        $this->tabSearchPossibility=[
            'reference'=>'numéro de commande',
            'user_id'=>"nom d'utilisateur",
        ];
        $this->tabSearchAscDescPossibility=[
            'total_price'=>'prix total',
        ];
    } 
}
