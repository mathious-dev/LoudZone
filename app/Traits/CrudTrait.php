<?php

namespace App\Traits;

use App\Models\Article;

trait CrudTrait
{
    public function crudLog($object,$action)
    {
        saveHistory("$action de {$object->getValueNameColumn()} {$object->getNameColumn()} ");
    }

    public function delete($id)
    {
        $find=$this->model::findOrFail($id);
        $this->crudLog($find,'Suppression');
        $find->delete();
        $this->flashSuccess("Suppression de {$find->getValueNameColumn()} {$find->getNameColumn()}");
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
        $this->flashSuccess("Enregistrement de {$object->getValueNameColumn()} {$object->getNameColumn()}");
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
        $this->flashSuccess("Enregistrement de {$object->getValueNameColumn()} {$object->getNameColumn()}");
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
        $this->flashSuccess("Enregistrement de {$objectMain->getValueNameColumn()} {$objectMain->getNameColumn()}");
        return $this->redirectRoute($route);
    }
    //Méthode de save pour les infos qui sont en null dans une liste
    public function saveNullInfo($data,$object,$column)
    {
        $object->update([
            $column => $data
        ]);
        $nameObject=$object->getValueNameColumn();
        $nameValue = $object->getNameColumn();
        $this->flashSuccess("Enregistrement de {$this->model} {$object->getNameColumn()}");
        saveHistory("La colonne null $column de {$nameObject} {$object->id} avec le nom : {$nameValue} a été mise à jour.");
    }
    public function savePermissionAndRole($object,$dataTab,$syncMethod,$dataRelation,$route)
    {
        $object->fill($dataTab);
        $object->save();

        $object->$syncMethod($dataRelation);
        $this->isCreateOrUpdateForLog($object);
        $this->flashSuccess("Enregistrement de {$object->getValueNameColumn()} {$object->getNameColumn()}");
        return $this->redirectRoute($route);
    }

    public function isCreateOrUpdateForLog($object)
    {
        if($this->isEditing)
            $this->crudLog($object,'Modification');
        else
            $this->crudLog($object,'Création');
    }

    public function flashSuccess($message)
    {
        session()->flash('flashMessage', [
            'type' => 'success',
            'message' => $message
        ]);
        //événement pour montrer le message flash quand on supprime
        $this->dispatch('flashMessage', type: 'success', message: $message);
    }

    public function flashError($message)
    {
        session()->flash('flashMessage', [
            'type' => 'error',
            'message' => $message
        ]);
        $this->dispatch('toast', type: 'success', message: $message);
    }
}
