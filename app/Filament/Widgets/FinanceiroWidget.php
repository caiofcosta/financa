<?php

namespace App\Filament\Widgets;

use App\Models\Lancamento;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class FinanceiroWidget extends ChartWidget
{
    protected static ?string $heading = 'Movimentações do Ano';

    protected function getData(): array
    {
        $entradas = Lancamento::join('categorias', 'categorias.id', '=', 'lancamentos.categoria_id')
            ->where('categorias.tipo', 'entrada')
            ->whereNull('lancamentos.deleted_at')
            ->select(DB::raw('MONTH(data) as mes'), DB::raw('SUM(valor) as total'))
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        $saidas = Lancamento::join('categorias', 'categorias.id', '=', 'lancamentos.categoria_id')
            ->where('categorias.tipo', 'saida')
            ->whereNull('lancamentos.deleted_at')
            ->select(DB::raw('MONTH(data) as mes'), DB::raw('SUM(valor) as total'))
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        // Preenche os meses sem lançamentos com zero
        $entradas = array_replace(array_fill(1, 12, 0), $entradas);
        $saidas = array_replace(array_fill(1, 12, 0), $saidas);

        return [
            'datasets' => [
                [
                    'label' => 'Entradas',
                    'data' => array_values($entradas),
                    'borderColor' => '#36A2EB',
                    'fill' => false
                ],
                [
                    'label' => 'Saídas',
                    'data' => array_values($saidas),
                    'borderColor' => '#FF6384',
                    'fill' => false
                ]
            ],
            'labels' => $meses,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
} 