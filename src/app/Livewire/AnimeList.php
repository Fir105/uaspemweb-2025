<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anime;

class AnimeList extends Component
{
    public $animes;

    public function mount()
    {
        $this->animes = Anime::latest()->get();
    }

    public function render()
    {
        return view('livewire.anime-list');
    }
}
