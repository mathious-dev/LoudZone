<?php

namespace App\Livewire\administration\supportMessage;

use App\Livewire\AdminComponent;
use App\Models\SupportMessage;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class SupportMessageList extends AdminComponent
{
    use WithPagination;
    use CrudTrait;
    use FilterTrait;
    protected $model=SupportMessage::class;
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'title';
        $this->tabSearchPossibility=[
            'title'=>'titre',
        ];
        $this->tabSearchAscDescPossibility=[
            'created_at'=>'date'
        ];
    }
    public function render()
    {
        return view('livewire.administration.supportMessage.support-message-list',['listSupportMessages'=>$this->querySupportMessage()]);
    }
    public function querySupportMessage()
    {
        $query=SupportMessage::query();
        $query=$this->search($query);
        $query=$this->searchAscDesc($query);
        return $query->paginate(10);
    }
    public function messageTreat(SupportMessage $message)
    {
        $message->changeState();
    }
}
