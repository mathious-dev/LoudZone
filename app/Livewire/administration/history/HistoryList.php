<?php

namespace App\Livewire\administration\history;

use App\Livewire\AdminComponent;
use App\Models\History;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class HistoryList extends AdminComponent
{
    use WithPagination;
    use FilterTrait;
    protected $model=History::class;
    public function render()
    {
        return view('livewire.administration.history.history-list',['listHistories'=>$this->queryHistory()]);
    }
    public function queryHistory()
    {
        $query=History::query();
        $query=$this->search($query);
        return $query->paginate(10);
    }
    public function delete($id)
    {
        $historyDelete=History::findOrFail($id);
        if($historyDelete)
            $historyDelete->delete();
    }
    public function mount()
    {
         $this->searchWichColumn = 'user_name';
        $this->tabSearchPossibility=[
            'user_name'=>"Nom d'utilisateur"];
    }
}
