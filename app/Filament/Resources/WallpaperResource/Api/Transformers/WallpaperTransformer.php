<?php
namespace App\Filament\Resources\WallpaperResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Wallpaper;

/**
 * @property Wallpaper $resource
 */
class WallpaperTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return $this->resource->toArray();
        return [
            'id' => $this->resource->id,    
            'slug' => $this->resource->slug,    
            'title' => $this->resource->title,    
            'description' => $this->resource->description,    
            'image_url' => $this->resource->image_url,    
            'category_id' => $this->resource->category_id,    
        ];
    }
}
