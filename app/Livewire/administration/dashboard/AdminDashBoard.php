<?php

namespace App\Livewire\administration\dashboard;

use App\Livewire\AdminComponent;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;

class AdminDashBoard extends AdminComponent
{
    public $eventPublish;
    public $countUserNewsletter;
    public $countUser;
    public $announcementPublish;
    public function render()
    {
        return view('livewire.administration.dashboard.admin-dash-board');
    }
    public function mount()
    {
        $this->getCountUser();
        $this->getCountUserNewsletter();
        $this->getAnnouncementPublish();
        $this->getEventPublish();
    }
    public function getCountUser()
    {
        $this->countUser=User::count();
    }
    public function getCountUserNewsletter()
    {
        $this->countUser = User::where('news_letter', true)->count();
    }
    public function getAnnouncementPublish()
    {
        $this->announcementPublish=Announcement::where('is_showing',true)->first();
    }
    public function getEventPublish()
    {
        $this->eventPublish=Event::where('is_important',true)->first();
    }

}
