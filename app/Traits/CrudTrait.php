<?php

namespace App\Traits;

trait CrudTrait
{
    public function delete($id)
    {
        $find=$this->model::findOrFail($id);
        //pour l'affichage dans l'historique
        $name=$find->getValueNameColumn();
        saveHistory("$name a été supprimé");
        $find->delete();
    }
    public function save($dataTab,$object,$route)
    {
        $object->fill($dataTab);
        $object->save();
        return $this->redirectRoute($route);
    }
}
