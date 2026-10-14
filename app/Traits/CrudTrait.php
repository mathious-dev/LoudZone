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
    public function save($dataTab,$object,$route, $relationName=null,$dataTabForRelation=[])
    {
        $object->fill($dataTab);
        $nameValue=$object->getValueNameColumn();
        $nameColumn=$object->getNameColumn();
        $object->save();
        if ($relationName!==null) 
            $object->$relationName()->sync($dataTabForRelation);
        if($this->isEditing)
            saveHistory("Modification de $nameColumn $nameValue");
        else
            saveHistory("Création de $nameColumn $nameValue");
        //pour la création de message support on vérifie si la route commence par http avec url()->previous()
        if (str_starts_with($route, 'http'))
            return redirect()->to($route); // Redirection vers l'URL
        return $this->redirectRoute($route);
    }
}
