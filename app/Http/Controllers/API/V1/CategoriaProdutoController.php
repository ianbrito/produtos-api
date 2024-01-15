<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\CategoriaProduto\EditaCategoriaProduto;
use App\Actions\CategoriaProduto\RegistraCategoriaProduto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaProdutoRequest;
use App\Http\Resources\CategoriaProdutoCollection;
use App\Http\Resources\CategoriaProdutoResource;
use App\Models\CategoriaProduto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CategoriaProdutoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProduto::query()->orderBy('id_categoria')->get();
        return new CategoriaProdutoCollection($categorias);
    }

    public function store(CategoriaProdutoRequest $request)
    {
        $data = $request->validated();

        try {
            $categoriaProduto = (new RegistraCategoriaProduto())->handle($data);
            return CategoriaProdutoResource::make($categoriaProduto);
        } catch (\Exception $e) {
            report($e);
            abort(code: Response::HTTP_INTERNAL_SERVER_ERROR, message: "Ocorreu um erro ao salvar categoria produto");
        }
    }

    public function show(int $id)
    {
        try {
            $categoriaProduto = CategoriaProduto::query()->findOrFail($id);

            return CategoriaProdutoResource::make($categoriaProduto);
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: 'categoria produto não encontrada');
        }
    }

    public function update(CategoriaProdutoRequest $request, int $id)
    {
        try {
            $data = $request->validated();

            $categoriaProduto = (new EditaCategoriaProduto())->handle($id, $data);

            return $categoriaProduto;
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: 'categoria produto não encontrada');
        }
    }

    public function destroy(int $id)
    {
        try {
            $categoriaProduto = CategoriaProduto::query()->findOrFail($id);

            DB::transaction(fn() => $categoriaProduto->delete());

            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            report($e);
            abort(code: Response::HTTP_NOT_FOUND, message: 'categoria produto não encontrada');
        } catch (\Exception $e) {
            report($e);
            abort(code: Response::HTTP_INTERNAL_SERVER_ERROR, message: "Ocorreu um erro ao remover categoria produto");
        }
    }
}
