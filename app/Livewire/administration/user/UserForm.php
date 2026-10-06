<?php

namespace App\Livewire\administration\user;

use App\Livewire\AdminComponent;
use App\Models\User;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Hash;


class UserForm extends AdminComponent
{
    use CrudTrait;
    public User $user;
    public $name = '';
    public $first_name = '';
    public $email = '';
    public $password = '';
    public $news_letter = false;
    protected function rules()
    {
        return [
            'name'        => 'required|string|max:255|min:2',
            'first_name'  => 'required|string|max:255|min:2',
            'email'       => 'required|string|max:255|min:5',
            'news_letter' => 'boolean',
            // Le mot de passe est OBLIGATOIRE à la création, mais FACULTATIF à la modification
            'password'    => $this->isEditing ? 'nullable|string|min:8|max:255' : 'required|string|min:8|max:255',
        ];
    }
    public function render()
    {
        return view('livewire.administration.user.user-form');
    }
    public function mount(User $user=null)
    {
        if($user&&$user->exists)
        {
            $this->user=$user;
            //on remplit toutes les variables directement
            //fill va chercher les informations et comparer aux variables publiques pour voir si ça correspond
            $this->fill($user->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->user=new User();
            $this->isEditing=false; 
        }
    }
    public function saveForm()
    {
        $dataTab=$this->validate();
        if(!empty($dataTab['password']))
            $dataTab['password']=Hash::make($dataTab['password']);
        else
            //on retire la ligne du tableau pour éviter de vider le mot de passe en édition
            unset($dataTab['password']);
        $this->save($dataTab,$this->user,"admin.userList");
    }
}
