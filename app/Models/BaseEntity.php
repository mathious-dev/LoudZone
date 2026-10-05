<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseEntity extends Model
{
    protected $nameColumn='name';
    //Cette méthode va permettre d'afficher le nom,label ou autre dans un message de suppression du trait
    public function getNameColumn()
    {
        //{} en plus pour pouvoir demander à PHP d'allez chercher la valeur
        return $this->{$this->nameColumn};
    }
}
