<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'cor',
        'icone'
    ];

    public function lancamentos(): HasMany
    {
        return $this->hasMany(Lancamento::class, 'categoria_id');
    }
} 