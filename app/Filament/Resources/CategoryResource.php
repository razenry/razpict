<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->debounce(1000)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = Str::slug($state);
                        $originalSlug = $slug;
                        $count = 1;

                        while (Category::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }

                        $set('slug', $slug);
                    })
                    ->required(),

                TextInput::make('slug')
                    ->readOnly()
                    ->required()
                    ->unique(Category::class, 'slug'),

                Textarea::make('description')->maxLength(255),

                FileUpload::make('image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->toggleable()->searchable(),
                TextColumn::make('slug')->sortable()->toggleable()->searchable(),
                TextColumn::make('description')->toggleable()->limit(20),
                ImageColumn::make('image')->toggleable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(), // Filter Soft Deletes
// Bisa dicari jika ada banyak kategori
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square')
                        ->color('primary')
                        ->visible(fn($record) => !$record->trashed()) // Sembunyikan tombol edit
                        ->disabled(fn($record) => $record->trashed()), // Mencegah klik jika dihapus

                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->color('danger'),

                    Tables\Actions\RestoreAction::make()
                        ->icon('heroicon-o-arrow-path')
                        ->color('success')
                        ->visible(fn($record) => $record->trashed()), // Hanya tampil jika dihapus
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()
                        ->icon('heroicon-o-arrow-path')
                        ->color('success'), // Bulk Restore
                    Tables\Actions\ForceDeleteBulkAction::make(), // Hard Delete
                ]),
            ])
            ->defaultSort('name')
            ->recordUrl(fn($record) => $record->trashed() ? null : route('filament.admin.resources.categories.edit', $record));

    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
