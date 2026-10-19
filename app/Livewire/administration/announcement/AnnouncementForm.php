<?php

namespace App\Livewire\administration\announcement;

use App\Livewire\AdminComponent;
use App\Models\Announcement;


class AnnouncementForm extends AdminComponent
{
    public $announcement;
    public $label;
    public $content;
    public $start_date;
    public $end_date;
    public $is_showing=false;
    public function render()
    {
        return view('livewire.administration.announcement.announcement-form');
    }
    public function mount(Announcement $announcement=null)
    {
         if($announcement&&!empty($announcement))
        {
            $this->announcement=$announcement;
            $this->fill($announcement->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->announcement=new Announcement();
            $this->isEditing=false;
        }
    }
    public function rules()
    {
        return ['label'=>'required|max:255','content'=>'required','start_date'=>'date|nullable','end_date'=>'date|nullable','is_showing'=>'boolean'];
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->announcement,'admin.announcementList');
    }
}
