<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'idProduto' => $this->id_produto,
            'nomeProduto' => $this->nome_produto,
            'valorProduto' => $this->valor_produto,
            'categoriaProduto' => CategoriaProdutoResource::make($this->categoriaProduto),
        ];
    }
}
