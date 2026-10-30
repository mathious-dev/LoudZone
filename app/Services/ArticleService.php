<?php
namespace App\Services;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Traits\CrudTrait;

class ArticleService 
{
    public $isEditing = false;
    use CrudTrait;
    public function saveArticle(Article $article,$data,$primary_image,$pictures,$isEditing)
    {
        $this->isEditing=$isEditing;
        //Pour l'image principale
        if($primary_image)
        {
            //store va enregistrer l'image dans un dossier 'articles' et renvoie le texte de l'image, un nom indéchiffrable
            $textImage = $primary_image->store('articles', 'public');
            $data['primary_image']=$textImage;
        }
        else
            //On supprime l'information du tableau ainsi à la sauvegarde il ne supprime pas l'image qui est déjà là si c'est null
            unset($data['primary_image']);

        //on ne doit pas mettre les images dans l'article
        unset($data['pictures']);

        //Livewire renvoie du texte vide et non un null
        if (empty($data['promotion_id'])) 
            $data['promotion_id'] = null;
        
        //Sauvegarde de l'article
        $articleSave=$this->save($data,$article,"admin.articleListAdmin");

        //Si c'est un vêtement
        if(ArticleCategory::isClotheCategory($articleSave->article_category_id))
        {
            $tabClothes = $data['tabClothes'] ?? [];
            foreach ($tabClothes as $clothe) 
            {
                $articleSave->clothes()->updateOrCreate([
                    'size'  => $clothe['size'],
                    'color' => $clothe['color']
                ]);
            }
            if($isEditing==true)
                saveHistory("Modification du vêtement {$articleSave->title}");
            else
                saveHistory("Création du vêtement {$articleSave->title}");
        }
        else
        {
            //Si le lien est encore là on le supprime
            if($articleSave->clothes()->exists())
            {
                $articleSave->clothe()->delete();
                saveHistory("Suppression des extensions vêtements pour {$articleSave->title}");
            }
        }
        //Pour les différentes images
        if($pictures)
        {
            foreach($pictures as $picture)
            {
                $textImage=$picture->store('articles','public');
                $articleSave->images()->create(['url'=>$textImage]);
            }
        }
    }

}