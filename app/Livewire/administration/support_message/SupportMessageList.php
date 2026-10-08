<?php

namespace App\Livewire\administration\support_message;

use App\Livewire\AdminComponent;
use App\Models\SupportMessage;

class SupportMessageList extends AdminComponent
{
    public function render()
    {
        return view('livewire.administration.support_message.support-message-list',['listSupportMessages'=>$this->querySupportMessage()]);
    }
    public function querySupportMessage()
    {
        $query=SupportMessage::query();
        return $query->paginate(10);
    }
}
