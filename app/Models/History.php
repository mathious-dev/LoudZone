<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
class History extends Model
{
    //cela va permettre de dire à Laravel d'ignorer la BD par défaut et de se connecter à MongoDB
    protected $connection = 'mongodb'; 
    //équivalent de la table, on l'écrit pour éviter les bugs de liaison
    protected $collection = 'histories';
    //équivalent de fillable sauf qu'ici on n'uatorise n'importe quelle donnée
    protected $guarded = [];
}
