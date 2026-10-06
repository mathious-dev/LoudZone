<?php

namespace App\Livewire\administration\user;

use App\Livewire\AdminComponent;
use App\Models\User;


class UserForm extends AdminComponent
{
    public User $user;
    public bool $isEditing=false;
    public $name = '';
    public $first_name = '';
    public $email = '';
    public $password = '';
    public $news_letter = false;
    protected $rules=['name'=>'required|string|max:255|min:2',
    'first_name'=>'required|string|max:255|min:2',
    'email'=>'required|string|max:255|min:5',
    'news_letter'=>'boolean',
    'password'=>'required|string|min:8|max:255',
    ];
    public function render()
    {
        return view('livewire.administration.user.user-form');
    }
    public function mount(User $user=null)
    {
        if($user&&$user->exists)
        {
            $this->user=$user;
            $this->name = $user->name;
            $this->first_name = $user->first_name;
            $this->email = $user->email;
            $this->news_letter = $user->news_letter;
            $this->isEditing=true;
        }
        else
        {
            $this->user=new User();
            $this->isEditing=false; 
        }
    }
    public function save()
    {
        $this->validate();
        $this->user->name = $this->name;
        $this->user->first_name = $this->first_name;
        $this->user->email = $this->email;
        $this->user->news_letter = $this->news_letter;
        $this->user->password=$this->password;
        $this->user->save();
        return $this->redirectRoute("admin.userList");
    }
}
