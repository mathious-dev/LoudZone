<?php

namespace App\Livewire\administration\article;

use App\Livewire\AdminComponent;
use App\Models\Article;
use App\Models\Category;
use App\Models\Clothe;
use App\Models\Promotion;
use App\Services\ArticleService;
use App\Traits\CrudTrait;
use Illuminate\Validation\Rule;
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
    public $category_id = '';
    public $primary_image='';
    public $pictures=[];
    public $promotion_id='';
    public $tabClothes = [
        ['size' => '','color' => '']
    ];

    public function render()
    {
        return view('livewire.administration.article.article-form-admin',
        ['listCategories'=>Article::getCategoryForArticle(),
        'listSizes'=> Clothe::getAvailableSizes(),
        'listColors'=>Clothe::getAvailableColors(),
        'listPromotions'=>$this->otherQuery(Promotion::class)]);
    }
    protected function rules()
    {
        $rules= [
            'title' => ['required','string','max:255',Rule::unique('articles', 'title')->ignore($this->article->id)],
            'description'=> 'nullable|string',
            'price_ht'=> 'required|numeric|min:0', 
            'slug' => 'required|string|max:255',
            'stock'=> 'required|integer|min:0', 
            'is_published'=> 'boolean',
            'tva'=> 'required|numeric|min:0',
            'primary_image' => 'nullable|image|max:1024',
            //On vérifie que les ID existent VRAIMENT dans la base de données
            'user_id'             => 'required|exists:users,id',//on vérifie dans la BD qu'il y a bien m'utilisateur
            'category_id' => 'required|exists:categories,id',
            'pictures'   => 'nullable|array',
            'pictures.*' => 'image|max:1024',
            'promotion_id'=>'nullable'
        ];
        if($this->isClothe())
        {
            $rules['tabClothes'] = 'array';
            $rules['tabClothes.*.size']='required|string';
            $rules['tabClothes.*.color']='nullable|string';
        }
        return $rules;
    }
    public function mount(Article $article=null)
    {
        if($article&&$article->exists)
        {
            $this->article=$article;
            $this->fill($article->toArray());
            if($this->article->clothes()->exists())
            {
                $this->tabClothes=[];
                foreach($this->article->clothes as $clothe)
                {
                    $this->tabClothes[]=[
                        'size'=>$clothe->size,
                        'color'=>$clothe->color
                    ];
                }
            }
            $this->primary_image = null;
            $this->isEditing=true;
        }
        else
        {
            $this->article=new Article();
            $this->isEditing=false;
            $this->user_id = auth()->id();
        }
    }
    public function isClothe()
    {
        return Category::isClotheCategory($this->category_id);
    }
    public function saveForm(ArticleService $articleService)
    {
        $data = $this->validate();
        $articleService->saveArticle($this->article,$data,$this->primary_image,$this->pictures,$this->isEditing);
        return redirect()->route('admin.articleListAdmin');
    }
    public function addTabClothes()
    {
        $this->tabClothes[]= ['size' => '','color' => ''];
    }
    public function deleteTabClothes($index)
    {
        unset($this->tabClothes[$index]);

        //on réorganise le tableau
        $this->tabClothes = array_values($this->tabClothes);
    }
}
