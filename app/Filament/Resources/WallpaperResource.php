<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WallpaperResource\Pages;
use App\Models\Wallpaper;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class WallpaperResource extends Resource
{
    protected static ?string $model = Wallpaper::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->debounce(1000)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = Str::slug($state);
                        $originalSlug = $slug;
                        $count = 1;

                        while (Wallpaper::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }

                        $set('slug', $slug);
                    })
                    ->required(),

                TextInput::make('slug')
                    ->readOnly()
                    ->required()
                    ->unique(Wallpaper::class, 'slug'),

                Textarea::make('description')
                    ->maxLength(255),

                FileUpload::make('image_url')
                    ->image()
                    ->required(),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->toggleable()->searchable(),
                TextColumn::make('slug')->toggleable()->searchable(),
                TextColumn::make('description')->limit(20)->toggleable()->searchable(),
                ImageColumn::make('image_url')->toggleable()->searchable(),
                TextColumn::make('category.name')->label('Category')->toggleable()->searchable(),
                TextColumn::make('created_at')->dateTime('d M Y')->sortable()->toggleable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Filter by Category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square')
                        ->color('primary')
                        ->visible(fn($record) => !$record->trashed())
                        ->disabled(fn($record) => $record->trashed()),

                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->color('danger'),

                    Tables\Actions\RestoreAction::make()
                        ->icon('heroicon-o-arrow-path')
                        ->color('success')
                        ->visible(fn($record) => $record->trashed()),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()
                        ->icon('heroicon-o-arrow-path')
                        ->color('success'),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(fn($record) => $record->trashed() ? null : route('filament.admin.resources.wallpapers.edit', $record));
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWallpapers::route('/'),
            'create' => Pages\CreateWallpaper::route('/create'),
            'edit' => Pages\EditWallpaper::route('/{record}/edit'),
        ];
    }
}
