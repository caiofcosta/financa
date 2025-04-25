<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?string $navigationLabel = 'Categorias';
    protected static ?string $modelLabel = 'Categoria';
    protected static ?string $pluralModelLabel = 'Categorias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descricao')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tipo')
                    ->required()
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ]),
                Forms\Components\ColorPicker::make('cor')
                    ->required(),
                Forms\Components\Select::make('icone')
                    ->required()
                    ->options([
                        'heroicon-o-currency-dollar' => 'Dinheiro',
                        'heroicon-o-home' => 'Casa',
                        'heroicon-o-shopping-cart' => 'Compras',
                        'heroicon-o-truck' => 'Transporte',
                        'heroicon-o-heart' => 'Saúde',
                        'heroicon-o-ticket' => 'Lazer',
                        'heroicon-o-academic-cap' => 'Educação',
                        'heroicon-o-computer-desktop' => 'Tecnologia',
                        'heroicon-o-chart-bar' => 'Investimentos',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success',
                        'saida' => 'danger',
                    }),
                Tables\Columns\ColorColumn::make('cor'),
                Tables\Columns\IconColumn::make('icone')
                    ->icon(fn (string $state): string => $state),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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