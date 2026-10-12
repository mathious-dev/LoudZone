<?php

namespace App\Livewire\administration\supportMessage;

use App\Livewire\AdminComponent;
use App\Models\SupportMessage;
class SupportMessageList extends AdminComponent
{

    protected $model=SupportMessage::class;
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'created_at';
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
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        if(empty($this->searchAscDesc))
            $query->orderByDesc('created_at');
        return $query->paginate(10);
    }
    public function messageTreat(SupportMessage $message)
    {
        $message->changeState();
    }
}
