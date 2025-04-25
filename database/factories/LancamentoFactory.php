<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Lancamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class LancamentoFactory extends Factory
{
    protected $model = Lancamento::class;

    public function definition(): array
    {
        return [
            'descricao' => $this->faker->sentence(3),
            'valor' => $this->faker->randomFloat(2, 1, 1000),
            'data' => $this->faker->date(),
            'categoria_id' => Categoria::factory(),
            'observacao' => $this->faker->optional()->text(),
        ];
    }
} 