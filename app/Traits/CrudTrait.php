<?php

namespace App\Traits;

trait CrudTrait
{
    public function delete($id)
    {
        $find=$this->model::findOrFail($id);
        //pour l'affichage dans l'historique
        $nameValue=$find->getValueNameColumn();
        $nameColumn=$find->getNameColumn();
        saveHistory("$nameColumn $nameValue a été supprimé");
        $find->delete();
    }
    public function save($dataTab,$object,$route)
    {
        $object->fill($dataTab);
        $nameValue=$object->getValueNameColumn();
        $nameColumn=$object->getNameColumn();
        $object->save();
        if($this->isEditing)
            saveHistory("Modification de $nameColumn $nameValue");
        else
            saveHistory("Création de $nameColumn $nameValue");
        return $this->redirectRoute($route);
    }
}
