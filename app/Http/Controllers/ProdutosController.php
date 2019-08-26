<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Firebase\JWT\JWT;
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
        return var_dump($request);

        $token = $request->header('AuthorizationToken');
        $dadosAutenticacao = JWT::decode($token, env('JWT_KEY'), ['HS256']);
        $fornecedor = Fornecedor::query()->where('emailFornecedor', '=', $dadosAutenticacao->emailFornecedor)->first();

        $produto = Produto::create(
            [
                'categoria' => $request->categoria,
                'nomeProduto' => $request->nomeProduto,
                'descProduto' => addslashes($request->descProduto),
                'preco' => $request->preco,
                'situacao' => 'A'
            ]
        );

        $produtoFornecedor = ProdutoFornecedor::create([
            'p_idProduto' => $produto->idProduto,
            'f_idFornecedor' => $fornecedor->idFornecedor,
            'quantidade' => 0
        ]);

        return response()->json($produto, 201);
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

        return redirect('http://puctcc.herokuapp.com/produtos/' . $request->idProduto . '/atualizarImagem');
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

        $produtoFornecedor = ProdutoFornecedor::query()->where([
            ['p_idProduto', '=', $request->idProduto],
            ['f_idFornecedor', '=', $request->idFornecedor]
        ])->first();

        if (is_null($produtoFornecedor)) {
            return response()->json('Recurso não encontrado.', 404, $header, JSON_UNESCAPED_UNICODE);
        }

        $produtoFornecedor->fill([
            'p_idProduto' => $request->idProduto,
            'f_idFornecedor' => $request->idFornecedor,
            'quantidade' => $request->quantidade
        ]);

        $produtoFornecedor->save();

        return response()->json($produtoFornecedor, 204);
    }
}
