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
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $produto = Produto::find($request->idProduto);
        if (is_null($produto)) {
            return response()->json('Recurso não encontrado.', 404, $header, JSON_UNESCAPED_UNICODE);
        }
        
        return redirect('http://puctcc.localhost/produtos/' . $request->idProduto . '/atualizarImagem');
    }

    public function update(Request $request)
    {
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $produto = Produto::find($request->idProduto);
        if (is_null($produto)) {
            return response()->json('Recurso não encontrado.', 404, $header, JSON_UNESCAPED_UNICODE);
        }
        
        $produto->fill($request->all());
        
        $produto->save();

        return response()->json($produto, 204);
    }

    public function atualizarEstoque(Request $request)
    {
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $produto = Produto::find($request->idProduto);
        if (is_null($produto)) {
            return response()->json('Recurso não encontrado.', 404, $header, JSON_UNESCAPED_UNICODE);
        }
        
        $produto->fill($request->all());
        
        $produto->save();

        return response()->json($produto, 204);
    }
}
