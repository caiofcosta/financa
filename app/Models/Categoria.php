<?php

namespace App\Models;

use App\Enums\TipoCategoriaEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'tipo',
    ];

    protected $casts = [
        'tipo' => TipoCategoriaEnum::class,
    ];

    public static function rules(): array
    {
        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias')->ignore(request()->route('categoria')),
            ],
            'tipo' => [
                'required',
                Rule::in([TipoCategoriaEnum::ENTRADA->value, TipoCategoriaEnum::SAIDA->value]),
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com este nome.',
            'tipo.required' => 'O tipo da categoria é obrigatório.',
            'tipo.in' => 'O tipo da categoria deve ser entrada ou saída.',
        ];
    }
} 