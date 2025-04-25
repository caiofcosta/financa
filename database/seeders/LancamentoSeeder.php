<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Lancamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LancamentoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();
        $categoriasEntrada = $categorias->where('tipo', 'entrada');
        $categoriasSaida = $categorias->where('tipo', 'saida');

        // Dados fixos mensais (acontecem todo mês)
        for ($mes = 1; $mes <= 12; $mes++) {
            // Salário
            Lancamento::create([
                'descricao' => 'Salário Mensal',
                'valor' => 5000.00,
                'data' => Carbon::create(2024, $mes, 5),
                'categoria_id' => $categoriasEntrada->where('nome', 'Salário')->first()->id,
            ]);

            // Aluguel
            Lancamento::create([
                'descricao' => 'Aluguel',
                'valor' => 1800.00,
                'data' => Carbon::create(2024, $mes, 10),
                'categoria_id' => $categoriasSaida->where('nome', 'Moradia')->first()->id,
            ]);

            // Conta de Luz
            Lancamento::create([
                'descricao' => 'Conta de Luz',
                'valor' => rand(150, 250),
                'data' => Carbon::create(2024, $mes, rand(5, 10)),
                'categoria_id' => $categoriasSaida->where('nome', 'Moradia')->first()->id,
            ]);

            // Supermercado (2x por mês)
            for ($i = 0; $i < 2; $i++) {
                Lancamento::create([
                    'descricao' => 'Compras Supermercado',
                    'valor' => rand(400, 600),
                    'data' => Carbon::create(2024, $mes, rand(1, 28)),
                    'categoria_id' => $categoriasSaida->where('nome', 'Alimentação')->first()->id,
                ]);
            }

            // Combustível (2x por mês)
            for ($i = 0; $i < 2; $i++) {
                Lancamento::create([
                    'descricao' => 'Combustível',
                    'valor' => rand(200, 300),
                    'data' => Carbon::create(2024, $mes, rand(1, 28)),
                    'categoria_id' => $categoriasSaida->where('nome', 'Transporte')->first()->id,
                ]);
            }
        }

        // Dados variáveis (acontecem em meses específicos)
        
        // Freelances
        $mesesFreelance = [2, 5, 7, 9, 11];
        foreach ($mesesFreelance as $mes) {
            Lancamento::create([
                'descricao' => 'Projeto Freelance Website',
                'valor' => rand(2000, 3500),
                'data' => Carbon::create(2024, $mes, rand(1, 28)),
                'categoria_id' => $categoriasEntrada->where('nome', 'Freelance')->first()->id,
            ]);
        }

        // Lazer
        $mesesLazer = [1, 3, 6, 7, 12];
        foreach ($mesesLazer as $mes) {
            Lancamento::create([
                'descricao' => 'Cinema e Jantar',
                'valor' => rand(150, 300),
                'data' => Carbon::create(2024, $mes, rand(1, 28)),
                'categoria_id' => $categoriasSaida->where('nome', 'Lazer')->first()->id,
            ]);
        }

        // Gastos extras sazonais
        $gastosExtras = [
            [3, 'IPTU', 'Moradia', 800],
            [7, 'Manutenção do Carro', 'Transporte', 1200],
            [12, 'Presente de Natal', 'Lazer', 500],
            [1, 'Compras Online', 'Alimentação', 300],
            [4, 'Assinatura Streaming', 'Lazer', 2000],
            [8, 'Manutenção Casa', 'Moradia', 1500],
        ];

        foreach ($gastosExtras as [$mes, $descricao, $categoria, $valor]) {
            Lancamento::create([
                'descricao' => $descricao,
                'valor' => $valor,
                'data' => Carbon::create(2024, $mes, rand(1, 28)),
                'categoria_id' => $categoriasSaida->where('nome', $categoria)->first()->id,
            ]);
        }
    }
}
