<?php

namespace App\Actions\CategoriaProduto;

use App\Models\CategoriaProduto;
use Illuminate\Support\Facades\DB;

class EditaCategoriaProduto
{
    public function handle(int $id, array $data): CategoriaProduto
    {
        $categoriaProduto = CategoriaProduto::query()->findOrFail($id);

        DB::transaction(fn() => $categoriaProduto->update($data));

        return $categoriaProduto;
    }
}
