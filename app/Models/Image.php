<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=['url',
    'imageable_id',
    'imageable_type'];
    //Cette méthode va nous permettre de savoir qui est le propriétaire de l'image
    //par exemple morphTo va directement allez voir imageable_id qui est 5 et imageable_type qui est Article, il comprend tout de suite que c'est l'article avec l'id 5
    //Il faut impérativement que ça soit imageable car morphTo va ajouter _id et _type
    public function imageable()
    {
        return $this->morphTo();
    }
}
