<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request as IlluminateRequest;

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

    public function show(IlluminateRequest $request)
    {
        $produto = Produto::query()->where('idProduto', '=', $request->idProduto)->get();
        
        if ($produto->isEmpty()) {
            return response()->json('', 204);
        } else {
            return response()->json($produto, 200);
        }

        
    }
}
