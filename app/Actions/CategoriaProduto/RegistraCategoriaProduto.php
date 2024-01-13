<?php

namespace App\Actions\CategoriaProduto;

use App\Models\CategoriaProduto;
use Illuminate\Support\Facades\DB;

class RegistraCategoriaProduto
{
    public function handle($data): CategoriaProduto
    {
        $categoria = DB::transaction(fn() => CategoriaProduto::query()->updateOrCreate($data));
        return $categoria;
    }
}
