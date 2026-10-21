<?php

namespace App\Services;

use App\Models\Produto;
use InvalidArgumentException;

class ProdutoService
{
    public function create(array $dados): Produto
    {
        if ($dados['valor'] <= 0) {
            throw new InvalidArgumentException('O valor deve ser maior que zero.');
        }

        return Produto::create($dados);
    }

    public function update(int $id, array $dados): Produto
    {
        $produto = Produto::findOrFail($id);

        if ($dados['valor'] <= 0) {
            throw new InvalidArgumentException('O valor deve ser maior que zero.');
        }

        $produto->update($dados);

        return $produto;
    }
}