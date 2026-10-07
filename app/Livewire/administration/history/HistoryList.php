<?php

namespace App\Livewire\administration\history;

use App\Models\History;
use App\Traits\CrudTrait;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryList extends Component
{
    use WithPagination;
    use CrudTrait;
    protected $model=History::class;
    public function render()
    {
        return view('livewire.history-list');
    }
    public function queryHistory()
    {
        $query=History::query();
        return $query->paginate(10);
    }
}
