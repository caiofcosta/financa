<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            // Receitas
            [
                'nome' => 'Salário',
                'descricao' => 'Rendimentos do trabalho',
                'tipo' => 'entrada',
                'cor' => '#00FF00',
                'icone' => 'heroicon-o-currency-dollar'
            ],
            [
                'nome' => 'Freelance',
                'descricao' => 'Trabalhos extras',
                'tipo' => 'entrada',
                'cor' => '#32CD32',
                'icone' => 'heroicon-o-computer-desktop'
            ],
            [
                'nome' => 'Investimentos',
                'descricao' => 'Rendimentos de aplicações',
                'tipo' => 'entrada',
                'cor' => '#90EE90',
                'icone' => 'heroicon-o-chart-bar'
            ],
            
            // Despesas
            [
                'nome' => 'Alimentação',
                'descricao' => 'Mercado, restaurantes e delivery',
                'tipo' => 'saida',
                'cor' => '#FF6B6B',
                'icone' => 'heroicon-o-shopping-cart'
            ],
            [
                'nome' => 'Moradia',
                'descricao' => 'Aluguel, contas e manutenção',
                'tipo' => 'saida',
                'cor' => '#4A90E2',
                'icone' => 'heroicon-o-home'
            ],
            [
                'nome' => 'Transporte',
                'descricao' => 'Combustível, transporte público e apps',
                'tipo' => 'saida',
                'cor' => '#FFA500',
                'icone' => 'heroicon-o-truck'
            ],
            [
                'nome' => 'Saúde',
                'descricao' => 'Plano de saúde, medicamentos e consultas',
                'tipo' => 'saida',
                'cor' => '#FF69B4',
                'icone' => 'heroicon-o-heart'
            ],
            [
                'nome' => 'Lazer',
                'descricao' => 'Entretenimento e hobbies',
                'tipo' => 'saida',
                'cor' => '#9370DB',
                'icone' => 'heroicon-o-ticket'
            ],
            [
                'nome' => 'Educação',
                'descricao' => 'Cursos e material didático',
                'tipo' => 'saida',
                'cor' => '#20B2AA',
                'icone' => 'heroicon-o-academic-cap'
            ]
        ];

        foreach ($categorias as $categoria) {
            Category::create($categoria);
        }
    }
}
