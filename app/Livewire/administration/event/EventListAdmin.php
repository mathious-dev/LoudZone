<?php

namespace App\Livewire\administration\event;

use App\Livewire\AdminComponent;
use App\Models\Event;


class EventListAdmin extends AdminComponent
{
    public $model=Event::class;
    public function render()
    {
        return view('livewire.administration.event.event-list-admin',['listEvents'=>$this->query(10)]);
    }
     public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'nom',
        ];
    }
}
