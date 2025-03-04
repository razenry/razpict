<?php

namespace App\Livewire\Home\Homepage;

use App\Models\Category;
use App\Models\Wallpaper;
use Livewire\Component;

class HomepageIndex extends Component
{
    public $title = 'Homepage';
    public $selectedCategory = null;
    public $categories = [];
    public $wallpapers = [];

    public function mount()
    {
        $this->categories = Category::withoutTrashed()->get();

        $this->loadWallpapers();
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadWallpapers(); 
    }

    public function loadWallpapers()
    {
        $this->wallpapers = Wallpaper::with('category')
            ->whereHas('category', function ($query) {
                $query->withoutTrashed();
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->withoutTrashed()
            ->get();
    }

    public function render()
    {
        return view('livewire.home.homepage.homepage-index')
            ->layout('livewire.home.layout.app', ['title' => $this->title]);
    }
}
