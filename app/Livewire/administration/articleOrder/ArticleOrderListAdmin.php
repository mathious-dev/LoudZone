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
        //à modifier
        $this->searchWichColumn='reference';
        $this->searchAscDescWichColumn = 'total_price';
        $this->tabSearchPossibility=[
            'reference'=>'Numéro de commande',
            'user_id'=>"Nom d'utilisateur",
        ];
        $this->tabSearchAscDescPossibility=[
            'total_price'=>'Prix total',
        ];
    } 
}
