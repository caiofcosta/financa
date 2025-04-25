<?php

namespace App\Filament\Widgets;

use App\Models\Lancamento;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class FinanceiroMensalWidget extends ChartWidget
{
    protected static ?string $heading = 'Movimentações por Categoria';

    protected function getData(): array
    {
        $dados = Lancamento::query()
            ->join('categorias', 'categorias.id', '=', 'lancamentos.categoria_id')
            ->select(
                'categorias.nome',
                'categorias.cor',
                DB::raw('SUM(valor) as total')
            )
            ->groupBy('categorias.nome', 'categorias.cor')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'data' => $dados->pluck('total')->toArray(),
                    'backgroundColor' => $dados->pluck('cor')->toArray(),
                ],
            ],
            'labels' => $dados->map(fn ($item) => "{$item->nome} (R$ " . number_format($item->total, 2, ',', '.') . ")")->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
} 