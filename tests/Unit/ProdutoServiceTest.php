<?php

namespace Tests\Unit;

use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class ProdutoServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_produto_nao_deve_ser_criado_com_preco_invalido(): void
    {
        $service = new ProdutoService();

        $this->expectException(InvalidArgumentException::class);

        $service->create([
            'nome' => 'Produto Teste',
            'descricao' => 'Produto para teste',
            'preco_custo' => 10.00,
            'preco' => 0,
            'quantidade' => 10
        ]);
    }

    public function test_update_deve_alterar_o_produto(): void
    {
        $produto = Produto::create([
            'nome' => 'Produto Antigo',
            'descricao' => 'Descrição antiga',
            'preco_custo' => 10.00,
            'preco' => 20.00,
            'quantidade' => 5
        ]);

        $service = new ProdutoService();

        $produtoAtualizado = $service->update($produto->id, [
            'nome' => 'Produto Atualizado',
            'descricao' => 'Descrição atualizada',
            'preco_custo' => 15.00,
            'preco' => 30.00,
            'quantidade' => 10
        ]);

        $this->assertEquals('Produto Atualizado', $produtoAtualizado->nome);
        $this->assertEquals(30.00, $produtoAtualizado->preco);
    }

    public function test_update_nao_deve_permitir_preco_invalido(): void
    {
        $produto = Produto::create([
            'nome' => 'Produto Teste',
            'descricao' => 'Descrição teste',
            'preco_custo' => 10.00,
            'preco' => 20.00,
            'quantidade' => 5
        ]);

        $service = new ProdutoService();

        $this->expectException(InvalidArgumentException::class);

        $service->update($produto->id, [
            'nome' => 'Produto Alterado',
            'descricao' => 'Descrição alterada',
            'preco_custo' => 10.00,
            'preco' => 0,
            'quantidade' => 5
        ]);
    }
}