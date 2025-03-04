<?php
namespace App\Filament\Resources\WallpaperResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\WallpaperResource;
use App\Filament\Resources\WallpaperResource\Api\Requests\CreateWallpaperRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = WallpaperResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Wallpaper
     *
     * @param CreateWallpaperRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateWallpaperRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}