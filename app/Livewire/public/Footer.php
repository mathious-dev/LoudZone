<?php

namespace App\Livewire\public;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.public.footer');
    }
    public function subNewsletterComponent()
    {
        subNewsLetter();
    }
}
