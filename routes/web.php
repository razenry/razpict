<?php

use App\Livewire\Home\Homepage\HomepageDetail;
use App\Livewire\Home\Homepage\HomepageIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageIndex::class)->name('home.index');
Route::get('/{slug}', HomepageDetail::class)->name('home.detail');
