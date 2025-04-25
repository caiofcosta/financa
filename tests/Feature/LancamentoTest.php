<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Lancamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LancamentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_um_lancamento_com_sucesso()
    {
        // Arrange
        $categoria = Categoria::factory()->create([
            'tipo' => 'entrada'
        ]);

        $dados = [
            'descricao' => 'Salário',
            'valor' => 3000.00,
            'data' => '2024-04-24',
            'categoria_id' => $categoria->id,
            'observacao' => 'Salário do mês'
        ];

        // Act
        $response = $this->postJson('/api/lancamentos', $dados);

        // Assert
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'descricao' => 'Salário',
                    'valor' => '3000.00',
                    'data' => '2024-04-24',
                    'categoria_id' => $categoria->id,
                    'observacao' => 'Salário do mês'
                ]
            ]);

        $this->assertDatabaseHas('lancamentos', [
            'descricao' => 'Salário',
            'valor' => 3000.00,
            'data' => '2024-04-24',
            'categoria_id' => $categoria->id,
            'observacao' => 'Salário do mês'
        ]);
    }

    /** @test */
    public function nao_pode_criar_lancamento_com_valor_negativo()
    {
        // Arrange
        $categoria = Categoria::factory()->create([
            'tipo' => 'entrada'
        ]);

        $dados = [
            'descricao' => 'Salário',
            'valor' => -100.00,
            'data' => '2024-04-24',
            'categoria_id' => $categoria->id,
            'observacao' => 'Salário do mês'
        ];

        // Act
        $response = $this->postJson('/api/lancamentos', $dados);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['valor']);

        $this->assertDatabaseMissing('lancamentos', [
            'descricao' => 'Salário',
            'valor' => -100.00
        ]);
    }

    /** @test */
    public function nao_pode_criar_lancamento_sem_categoria_valida()
    {
        // Arrange
        $dados = [
            'descricao' => 'Salário',
            'valor' => 3000.00,
            'data' => '2024-04-24',
            'categoria_id' => 999, // ID inexistente
            'observacao' => 'Salário do mês'
        ];

        // Act
        $response = $this->postJson('/api/lancamentos', $dados);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['categoria_id']);

        $this->assertDatabaseMissing('lancamentos', [
            'descricao' => 'Salário',
            'valor' => 3000.00
        ]);
    }

    /** @test */
    public function pode_listar_lancamentos()
    {
        // Arrange
        $categoria = Categoria::factory()->create();
        $lancamento = Lancamento::factory()->create([
            'categoria_id' => $categoria->id
        ]);

        // Act
        $response = $this->getJson('/api/lancamentos');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $lancamento->id,
                        'descricao' => $lancamento->descricao,
                        'valor' => number_format($lancamento->valor, 2, '.', ''),
                        'data' => $lancamento->data->format('Y-m-d'),
                        'categoria_id' => $categoria->id,
                        'observacao' => $lancamento->observacao
                    ]
                ]
            ]);
    }
} 