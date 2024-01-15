<?php

namespace App\Actions\Produto;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class RegistraProduto
{
    public function handle($data): Produto
    {
        $data = array_merge($data, ['data_cadastro' => now()]);
        return DB::transaction(fn() => Produto::query()->updateOrCreate($data));
    }
}
