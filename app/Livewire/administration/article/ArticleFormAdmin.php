<?php

namespace App\Livewire\administration\article;

use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Traits\CrudTrait;
use Livewire\WithFileUploads;

class ArticleFormAdmin extends AdminComponent
{
    use WithFileUploads;
    use CrudTrait;
    public Article $article;
    public $title = '';
    public $description = '';
    public $price_ht = '';
    public $slug = '';
    public $stock = 0; 
    public $is_published = false; 
    public $tva = '';
    public $user_id = '';
    public $article_category_id = '';
    public $primary_image='';
    public function render()
    {
        return view('livewire.administration.article.article-form-admin',['listArticleCategories'=>$this->queryCategories()]);
    }
    protected function rules()
    {
        return [
            'title'=> 'required|string|max:255',
            'description'=> 'nullable|string',
            'price_ht'=> 'required|numeric|min:0', 
            'slug' => 'required|string|max:255',
            'stock'=> 'required|integer|min:0', 
            'is_published'=> 'boolean',
            'tva'=> 'required|numeric|min:0',
            'primary_image' => 'nullable|image|max:1024',
            //On vérifie que les ID existent VRAIMENT dans la base de données
            'user_id'             => 'required|exists:users,id',//on vérifie dans la BD qu'il y a bien m'utilisateur
            'article_category_id' => 'required|exists:article_categories,id',
        ];
    }
    public function queryCategories()
    {
        $query=ArticleCategory::query();
        return $query->get();
    }
    public function mount(Article $article=null)
    {
        if($article&&$article->exists)
        {
            $this->article=$article;
            $this->fill($article->toArray());

            $this->isEditing=true;
        }
        else
        {
            $this->article=new Article();
            $this->isEditing=false;
            $this->user_id = auth()->id();
        }
    }
    public function saveForm()
    {
        $data = $this->validate();
        if($this->primary_image)
        {
            //store va enregistrer l'image dans un dossier 'articles' et renvoie le texte de l'image, un nom indéchiffrable
            $textImage = $this->primary_image->store('articles', 'public');
            $data['primary_image']=$textImage;
        }
        $this->save($data,$this->article,"admin.articleListAdmin",'articleCategory',$this->ArticleCategoryChoice);
    }
    

}
