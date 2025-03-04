<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallpaper extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_url',
        'category_id',
        'tags',
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
