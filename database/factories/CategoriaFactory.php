<?php

namespace Database\Factories;

use App\Enums\TipoCategoriaEnum;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->word,
            'tipo' => $this->faker->randomElement([TipoCategoriaEnum::ENTRADA->value, TipoCategoriaEnum::SAIDA->value]),
        ];
    }
} 