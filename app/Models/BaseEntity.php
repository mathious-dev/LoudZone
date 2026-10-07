<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseEntity extends Model
{
    protected $nameValueColumn='name';
    protected $nameColumn='base';
    //Cette méthode va permettre d'afficher le nom,label ou autre dans un message de suppression du trait
    public function getValueNameColumn()
    {
        //{} en plus pour pouvoir demander à PHP d'allez chercher la valeur
        return $this->{$this->nameValueColumn};
    }
    public function getNameColumn()
    {
        return $this->nameColumn;
    }
}
