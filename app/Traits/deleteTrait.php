<?php

namespace App\Traits;

trait deleteTrait
{
    public function delete($id)
    {
        $find=$this->model::findOrFail($id);
        //pour l'affichage dans l'historique
        $name=$find->getValueNameColumn();
        saveHistory("$name a été supprimé");
        $find->delete();
    }
}
