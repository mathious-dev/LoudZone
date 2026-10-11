<?php

namespace App\Livewire\administration\articleOrder;

use App\Livewire\AdminComponent;
use App\Models\ArticleOrder;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;



class ArticleOrderListAdmin extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    public $model=ArticleOrder::class;
    public function render()
    {
        return view('livewire.administration.articleOrder.article-order-list-admin');
    }
}
