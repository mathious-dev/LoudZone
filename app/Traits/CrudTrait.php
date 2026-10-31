<?php

namespace App\Traits;

use App\Models\Article;

trait CrudTrait
{
    public function crudLog($object,$action)
    {
        //pour l'affichage dans l'historique si c'est la classe rôle ou permission
        $nameColumn = method_exists($object, 'getNameColumn') ? $object->getNameColumn() : class_basename($object);
        $nameValue = method_exists($object, 'getValueNameColumn') ? $object->getValueNameColumn() : $object->name;
        saveHistory("$action de $nameColumn $nameValue ");
    }
    public function delete($id)
    {
        $find=$this->model::findOrFail($id);
        $this->crudLog($find,'Suppression');
        $find->delete();
    }
    //Méthode de save basique
    public function save($dataTab,$object,$route)
    {
        $object->fill($dataTab);
        $object->save();

        $this->isCreateOrUpdateForLog($object);

        //pour la création de message support on vérifie si la route commence par http avec url()->previous()
        if (str_starts_with($route, 'http'))
            return redirect()->to($route); // Redirection vers l'URL

        if($object instanceof Article)
            return $object;
        
        return $this->redirectRoute($route);
    }
    //Méthode de save pour les relations manyToMany
    public function saveManyToMany($object,$dataTab,$relationName,$dataTabRelation,$route)
    {
        $object->fill($dataTab);
        $object->save();
        if($relationName)
            $object->$relationName()->sync($dataTabRelation);

        $this->isCreateOrUpdateForLog($object);
        return $this->redirectRoute($route);
    }
    //Méthode de save pour les relations OneToMany mais côté belongsTo si jamais on crée 2 objets de 2 tables différents en même temps. 
    // Exemple : avec événement et adresse
    public function saveBelongsTo($objectMain,$dataTabMain,$objectRelation,$dataTabForRelation=[],$foreignKey,$route)
    {
        $objectRelation->fill($dataTabForRelation);
        $objectRelation->save();

        //Il faut que l'objet principal puisse avoir la clé étrangère
        $dataTabMain[$foreignKey]=$objectRelation->id;

        $objectMain->fill($dataTabMain);
        $objectMain->save();

        $this->isCreateOrUpdateForLog($objectMain);

        return $this->redirectRoute($route);
    }
    //Méthode de save pour les infos qui sont en null dans une liste
    public function saveNullInfo($data,$object,$column)
    {
        $object->update([
            $column => $data
        ]);
        $nameObject=$object->getNameColumn();
        $nameValue = $object->getValueNameColumn();
        saveHistory("La colonne null $column de {$nameObject} {$object->id} avec le nom : {$nameValue} a été mise à jour.");
    }
    public function savePermissionAndRole($object,$dataTab,$syncMethod,$dataRelation,$route)
    {
        $object->fill($dataTab);
        $object->save();

        $object->$syncMethod($dataRelation);
        $this->isCreateOrUpdateForLog($object);
        return $this->redirectRoute($route);
    }
    public function isCreateOrUpdateForLog($object)
    {
        if($this->isEditing)
            $this->crudLog($object,'Modification');
        else
            $this->crudLog($object,'Création');
    }
}
