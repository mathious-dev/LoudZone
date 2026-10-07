<?php

namespace App\Livewire\administration\history;

use App\Livewire\AdminComponent;
use App\Models\History;
use App\Traits\CrudTrait;
use Livewire\WithPagination;

class HistoryList extends AdminComponent
{
    use WithPagination;
    use CrudTrait;
    protected $model=History::class;
    public function render()
    {
        return view('livewire.administration.history.history-list',['listHistories'=>$this->queryHistory()]);
    }
    public function queryHistory()
    {
        $query=History::query();
        return $query->paginate(10);
    }
}
