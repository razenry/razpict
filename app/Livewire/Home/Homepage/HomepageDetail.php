<?php

namespace App\Livewire\Home\Homepage;

use App\Models\Wallpaper;
use Livewire\Component;

class HomepageDetail extends Component
{
    public $wallpaper;

    public function mount($slug)
    {
        $this->wallpaper = Wallpaper::with('category')
            ->where('slug', $slug)
            ->withoutTrashed()
            ->firstOrFail();
    }

    public function download()
    {
        return response()->download(public_path('storage/'.$this->wallpaper->image_url));
    }

    public function render()
    {
        return view('livewire.home.homepage.homepage-detail')
            ->layout('livewire.home.layout.app', ['title' => $this->wallpaper->title]);
    }
}
