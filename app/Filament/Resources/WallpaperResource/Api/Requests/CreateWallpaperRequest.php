<?php

namespace App\Filament\Resources\WallpaperResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWallpaperRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'title' => 'required|string',
			'slug' => 'required|string',
			'description' => 'required|string',
			'image_url' => 'required|string',
			'category_id' => 'required|integer',
			'deleted_at' => 'required'
		];
    }
}
