<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return response()->json(Produto::all(), 200);
    }

    public function show(Request $request)
    {
        $produto = Produto::query()->where('idProduto', '=', $request->idProduto)->get();

        if ($produto->isEmpty()) {
            return response()->json(null, 404);
        } else {
            return response()->json($produto, 200);
        }
    }

    public function store(Request $request)
    {
        return response()->json(
            Produto::create(
                [
                    'categoria' => $request->categoria,
                    'nomeProduto' => $request->nomeProduto,
                    'descProduto' => $request->descProduto,
                    'preco' => $request->valor,
                    'situacao' => 'A'
                ]
            ),
            201
        );
    }

    public function atualizarImagem(Request $request)
    {
        $fileName = 'download.png';
        $path = $request->file('photo')->move('../../puctcc/', $fileName);
        $photoURL = url($fileName);
        return response()->json(['url' => $photoURL], 200);
    }
}
