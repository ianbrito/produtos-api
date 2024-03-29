<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    protected $table = 'tb_categoria_produto';

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nome_categoria',
    ];

    public $timestamps = null;
}
