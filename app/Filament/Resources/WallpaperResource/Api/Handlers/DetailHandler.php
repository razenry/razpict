<?php

namespace App\Filament\Resources\WallpaperResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\WallpaperResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\WallpaperResource\Api\Transformers\WallpaperTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = WallpaperResource::class;

    public static bool $public = true;
    /**
     * Show Wallpaper
     *
     * @param Request $request
     * @return WallpaperTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new WallpaperTransformer($query);
    }
}
