<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Produto\EditaProduto;
use App\Actions\Produto\RegistraProduto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Http\Resources\ProdutoCollection;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::query()->orderBy('id_produto')->get();
        return ProdutoCollection::make($produtos);
    }

    public function store(ProdutoRequest $request)
    {
        try {
            $data = $request->validated();

            $produto = (new RegistraProduto())->handle($data);

            return ProdutoResource::make($produto);
        } catch (\Exception $e) {
            report($e);
            abort(
                code: Response::HTTP_INTERNAL_SERVER_ERROR,
                message: "Ocorreu um erro ao salvar as informações do produto!"
            );
        }
    }

    public function show(int $id)
    {
        try {
            $produto = Produto::query()->findOrFail($id);
            return ProdutoResource::make($produto);
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: "Produto não encontrado!");
        }
    }

    public function update(ProdutoRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $produto = (new EditaProduto())->handle($id, $data);
            return ProdutoResource::make($produto);
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: "Produto não encontrado!");
        } catch (\Exception $e) {
            report($e);
            abort(
                code: Response::HTTP_INTERNAL_SERVER_ERROR,
                message: "Ocorreu um erro ao alterar as informações do produto!"
            );
        }
    }

    public function destroy($id)
    {
        try {
            $produto = Produto::query()->findOrFail($id);
            DB::transaction(fn() => $produto->delete());
            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: "Produto não encontrado!");
        }
    }
}
