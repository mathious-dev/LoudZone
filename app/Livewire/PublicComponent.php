<?php

namespace App\Livewire;

use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use App\Traits\QueryTrait;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('livewire.public.public-side')]
class PublicComponent extends Component
{
    public bool $isEditing=false;
    use CrudTrait,QueryTrait,FilterTrait,WithPagination;
}
