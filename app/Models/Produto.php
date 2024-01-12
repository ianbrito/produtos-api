<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tb_produto';

    protected $fillable = [
        'id_produto',
        'id_categoria_produto',
        'data_cadastro',
        'nome_produto',
        'valor_produto',
    ];
}
