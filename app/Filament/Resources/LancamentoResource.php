<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LancamentoResource\Pages;
use App\Models\Lancamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LancamentoResource extends Resource
{
    protected static ?string $model = Lancamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?string $navigationLabel = 'Lançamentos';
    protected static ?string $modelLabel = 'Lançamento';
    protected static ?string $pluralModelLabel = 'Lançamentos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descricao')
                    ->required()
                    ->maxLength(255)
                    ->label('Descrição')
                    ->placeholder('Digite a descrição do lançamento'),

                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->numeric()
                    ->prefix('R$')
                    ->mask('999.999.999,99')
                    ->label('Valor')
                    ->placeholder('0,00'),

                Forms\Components\DatePicker::make('data')
                    ->required()
                    ->label('Data')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->closeOnDateSelection(),

                Forms\Components\Select::make('categoria_id')
                    ->relationship('categoria', 'nome')
                    ->required()
                    ->label('Categoria')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nome')
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
                    ]),

                Forms\Components\Textarea::make('observacao')
                    ->label('Observação')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descricao')
                    ->label('Descrição')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('valor')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable()
                    ->alignment('end')
                    ->color(fn (Lancamento $record): string => 
                        $record->categoria->tipo === 'entrada' ? 'success' : 'danger'
                    ),

                Tables\Columns\TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('categoria.nome')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ViewColumn::make('categoria.icone')
                    ->label('Ícone')
                    ->view('filament.tables.columns.icon-with-color'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->relationship('categoria', 'nome')
                    ->label('Categoria'),
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $tipo): Builder =>
                                $query->whereHas('categoria', fn ($q) => $q->where('tipo', $tipo))
                        );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('data', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLancamentos::route('/'),
            'create' => Pages\CreateLancamento::route('/create'),
            'edit' => Pages\EditLancamento::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('categoria');
    }
} 