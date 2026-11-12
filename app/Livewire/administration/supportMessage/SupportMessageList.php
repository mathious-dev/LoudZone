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
        $this->searchCategoryWichColumn='category_id';
        $this->searchAscDesc = 'DESC';
        $this->tabSearchPossibility=[
            'title'=>'titre',
        ];
        $this->tabSearchAscDescPossibility=[
            'created_at'=>'date'
        ];
        $this->tabSearchCategoryPossibility=SupportMessage::getCategoryForSupportMessage();
        if(request()->query('category_id'))
            $this->searchCategory=request()->query('category_id');

    }
    public function render()
    {
        return view('livewire.administration.supportMessage.support-message-list',['listSupportMessages'=>$this->query(withRelations:['category','user','addInfo'],orderByColumn:'created_at'),
        'listSearch'=>$this->querySearch(),]);
    }
    public function messageTreat(SupportMessage $message)
    {
        $message->changeState();
    }
}
