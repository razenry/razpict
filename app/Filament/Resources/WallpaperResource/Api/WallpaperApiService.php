<?php
namespace App\Filament\Resources\WallpaperResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\WallpaperResource;
use Illuminate\Routing\Router;


class WallpaperApiService extends ApiService
{
    protected static string | null $resource = WallpaperResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
