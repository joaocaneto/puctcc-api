<?php

namespace App\Http\Controllers;

use App\Models\Produto;

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
}
