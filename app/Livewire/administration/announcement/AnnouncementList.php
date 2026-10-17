<?php

namespace App\Livewire\administration\announcement;

use App\Livewire\AdminComponent;
use App\Models\Announcement;


class AnnouncementList extends AdminComponent
{
    public $model=Announcement::class;
    public function render()
    {
        return view('livewire.administration.announcement.announcement-list',['listAnnouncements'=>$this->query(10)]);
    }
}
