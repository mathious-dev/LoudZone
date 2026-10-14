<?php

namespace App\Livewire\administration\supportMessage;

use App\Livewire\AdminComponent;
use App\Models\SupportMessage;
use App\Models\SupportMessageCategory;

class SupportMessageList extends AdminComponent
{

    protected $model=SupportMessage::class;
    public function mount()
    {
        $this->searchWichColumn='title';
        $this->searchAscDescWichColumn = 'created_at';
        $this->searchCategoryWichColumn='support_message_category_id';
        $this->tabSearchPossibility=[
            'title'=>'titre',
        ];
        $this->tabSearchAscDescPossibility=[
            'created_at'=>'date'
        ];
        $this->tabSearchCategoryPossibility=SupportMessageCategory::pluck('label','id')->toArray();
        if(request()->query('support_message_category_id'))
        {
            $this->searchCategory=request()->query('support_message_category_id');
        }
    }
    public function render()
    {
        return view('livewire.administration.supportMessage.support-message-list',['listSupportMessages'=>$this->querySupportMessage()]);
    }
    //On utilise pas le trait avec le query car celui-ci est trié par défaut par date
    public function querySupportMessage()
    {
        $query=SupportMessage::query();
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        $query=$this->searchCategoryFunction($query);
        if(empty($this->searchAscDesc))
            $query->orderByDesc('created_at');
        return $query->paginate(10);
    }
    public function messageTreat(SupportMessage $message)
    {
        $message->changeState();
    }
}
