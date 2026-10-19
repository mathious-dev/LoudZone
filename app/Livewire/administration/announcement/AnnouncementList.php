<?php

namespace App\Livewire\administration\announcement;

use App\Livewire\AdminComponent;
use App\Models\Announcement;


class AnnouncementList extends AdminComponent
{
    public $model=Announcement::class;
    public $start_date;
    public $end_date;
    public function render()
    {
        return view('livewire.administration.announcement.announcement-list',['listAnnouncements'=>$this->query(10)]);
    }
    public function publishing(Announcement $announcement)
    {
        if($announcement->IsDateCorrect($this->start_date,$this->end_date))
        {
            $this->validate();
            $announcement->update([
                'is_showing'=>true,
                'start_date'=>$this->start_date,
                'end_date'=>$this->end_date
            ]);

            $this->start_date = null;
            $this->end_date = null;
        }
    }
    public function rules()
    {
        return 
        ['start_date'=>'required',
        'end_date'=>'required',];
    }
}
