<?php

namespace App\Livewire\administration\event;

use App\Livewire\AdminComponent;
use App\Models\Event;


class EventListAdmin extends AdminComponent
{
    public $model=Event::class;
    public function render()
    {
        return view('livewire.administration.event.event-list-admin',['listEvents'=>$this->query(10,['address']),
        'listSearch'=>$this->querySearch()]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'Nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'Nom',
            'start_date'=>'Date de début',
            'end_date'=>'Date de fin',
        ];
        if(request()->query('eventPublishLabel'))
            $this->search=request()->query('eventPublishLabel');
    }
    public function changePublish(Event $event)
    {
        $event->publishOrNot();
    }
}
