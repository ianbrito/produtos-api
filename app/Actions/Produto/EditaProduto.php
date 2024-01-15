<?php

namespace App\Actions\Produto;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class EditaProduto
{
    public function handle($id, $data): Produto
    {
        $produto = Produto::query()->findOrFail($id);
        DB::transaction(fn() => $produto->query()->update($data));
        return $produto;
    }
}
