<?php

namespace App\Traits;

use App\Models\Article;

trait CrudTrait
{
    public function delete($id)
    {
        $find=$this->model::findOrFail($id);

        //pour l'affichage dans l'historique si c'est la classe rôle ou permission
        $nameColumn = method_exists($find, 'getNameColumn') ? $find->getNameColumn() : class_basename($find);
        $nameValue = method_exists($find, 'getValueNameColumn') ? $find->getValueNameColumn() : $find->name;
        saveHistory("$nameColumn $nameValue a été supprimé");
        $find->delete();
    }
    public function save($dataTab,$object,$route, $relationName=null,$dataTabForRelation=[])
    {
        $object->fill($dataTab);
        $object->save();

        if ($relationName!==null) 
            $object->$relationName()->sync($dataTabForRelation);

        //pour l'affichage dans l'historique si c'est la classe rôle ou permission
        $nameColumn = method_exists($object, 'getNameColumn') ? $object->getNameColumn() : class_basename($object);
        $nameValue = method_exists($object, 'getValueNameColumn') ? $object->getValueNameColumn() : $object->name;
        
        if($this->isEditing)
            saveHistory("Modification de $nameColumn $nameValue");
        else
            saveHistory("Création de $nameColumn $nameValue");

        //pour la création de message support on vérifie si la route commence par http avec url()->previous()
        if (str_starts_with($route, 'http'))
            return redirect()->to($route); // Redirection vers l'URL

        if($object instanceof Article)
            return $object;
        
        return $this->redirectRoute($route);
    }
    public function saveNullInfo($data,$object,$column)
    {
        $object->update([
            $column => $data
        ]);
        $nameObject=$object->getNameColumn();
        $nameValue = $object->getValueNameColumn();
        saveHistory("La colonne null $column de {$nameObject} {$object->id} avec le nom : {$nameValue} a été mise à jour.");
    }
}
