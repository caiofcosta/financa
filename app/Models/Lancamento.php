<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Lancamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lancamentos';

    protected $fillable = [
        'descricao',
        'valor',
        'data',
        'categoria_id',
        'observacao',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data' => 'date',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public static function rules(): array
    {
        return [
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01',
            'data' => 'required|date',
            'categoria_id' => [
                'required',
                'integer',
                Rule::exists('categorias', 'id'),
            ],
            'observacao' => 'nullable|string',
        ];
    }

    public static function messages(): array
    {
        return [
            'descricao.required' => 'A descrição do lançamento é obrigatória.',
            'valor.required' => 'O valor do lançamento é obrigatório.',
            'valor.min' => 'O valor do lançamento deve ser maior que zero.',
            'data.required' => 'A data do lançamento é obrigatória.',
            'categoria_id.required' => 'A categoria do lançamento é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
        ];
    }
} 