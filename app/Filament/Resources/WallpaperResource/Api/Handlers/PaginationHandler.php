<?php
namespace App\Filament\Resources\WallpaperResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\WallpaperResource;
use App\Filament\Resources\WallpaperResource\Api\Transformers\WallpaperTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = WallpaperResource::class;
    public static bool $public = true;

    /**
     * List of Wallpaper
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return WallpaperTransformer::collection($query);
    }
}
