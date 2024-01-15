<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $table = 'tb_produto';

    protected $primaryKey = 'id_produto';

    protected $fillable = [
        'id_categoria_produto',
        'data_cadastro',
        'nome_produto',
        'valor_produto',
    ];

    public $timestamps = null;

    public function categoriaProduto(): BelongsTo
    {
        return $this->belongsTo(CategoriaProduto::class, 'id_categoria_produto');
    }
}
