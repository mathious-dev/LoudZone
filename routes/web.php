<?php

use App\Livewire\administration\addInfo\AddInfoForm;
use App\Livewire\administration\addInfo\AddInfoList;
use App\Livewire\administration\article\ArticleFormAdmin;
use App\Livewire\administration\article\ArticleListAdmin;
use App\Livewire\administration\articleCategory\ArticleCategoryForm;
use App\Livewire\administration\ArticleCategory\ArticleCategoryList;
use App\Livewire\administration\history\HistoryList;
use App\Livewire\administration\role\RoleForm;
use App\Livewire\administration\role\RoleList;
use App\Livewire\administration\supportMessage\SupportMessageList;
use App\Livewire\administration\SupportMessageCategory\SupportMessageCategoryForm;
use App\Livewire\administration\SupportMessageCategory\SupportMessageCategoryList;
use App\Livewire\administration\user\UserForm;
use App\Livewire\administration\user\UserList;
use App\Livewire\public\article\ArticleDetail;
use App\Livewire\public\article\ArticleListPublic;
use App\Livewire\public\supportMessage\SupportMessageForm;
use App\Models\SupportMessageCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware(['role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

        //utilisateurs
        Route::get('/users',UserList::class)->name('userList');
        Route::get('/user/create',UserForm::class)->name('userForm.create');
        Route::get('/user/edit/{user}',UserForm::class)->name('userForm.edit');

        //role 
        Route::get('/roles',RoleList::class)->name('roleList');
        Route::get('/role/create',RoleForm::class)->name('roleForm.create');
        Route::get('/role/edit/{role}',RoleForm::class)->name('roleForm.edit');

        //Article
        Route::get('/articles',ArticleListAdmin::class)->name('articleListAdmin');
        Route::get('/article/create',ArticleFormAdmin::class)->name('articleForm.create');
        Route::get('/article/edit/{article}',ArticleFormAdmin::class)->name('articleForm.edit');

        //Historique
        Route::get('/histories',HistoryList::class)->name('historiesList');

        //Message support
        Route::get('/supportMessages',SupportMessageList::class)->name('supportMessageList');

        //Catégorie d'articles
        Route::get('/articleCategories',ArticleCategoryList::class)->name('articleCategoryList');
        Route::get('/articleCategory/create',ArticleCategoryForm::class)->name('articleCategory.create');
        Route::get('/articleCategory/edit/{articleCategory}',ArticleCategoryForm::class)->name('articleCategory.edit');

        //Infos supplémentaires
        Route::get('/addInfos',AddInfoList::class)->name('addInfoList');
        Route::get('/addInfo/create',AddInfoForm::class)->name('addInfo.create');
        Route::get('/addInfo/edit/{addInfo}',AddInfoForm::class)->name('addInfo.edit');

        //Catégorie d'articles
        Route::get('/supportMessageCategories',SupportMessageCategoryList::class)->name('supportMessageCategoryList');
        Route::get('/supportMessageCategory/create',SupportMessageCategoryForm::class)->name('supportMessageCategory.create');
        Route::get('/supportMessageCategory/edit/{supportMessageCategory}',SupportMessageCategoryForm::class)->name('supportMessageCategory.edit');
    });

    //Article
    Route::get('/articles',ArticleListPublic::class)->name('articleListPublic');
    Route::get('/article/{article}',ArticleDetail::class)->name('articleDetail');

    //Message Support
    Route::get('/supportMessage/create',SupportMessageForm::class)->name('supportMessage.create');
});
