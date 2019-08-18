<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function login(Request $request)
    {
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $this->validate($request, [
            'emailFornecedor' => 'required|email',
            'password' => 'required'
        ]);

        $fornecedor = Fornecedor::query()->where([
            ['emailFornecedor', '=', $request->emailFornecedor],
            ['situacao', '=', 'L']
        ])->first();

        if (is_null($fornecedor) || !Hash::check($request->password, $fornecedor->password)) {
            return response()->json(
                'Usuário ou senha inválido.',
                401,
                $header,
                JSON_UNESCAPED_UNICODE
            );
        }

        if ($fornecedor->situacao != 'L') {
            return response()->json(
                'Seu usuário está bloqueado. Entre em contato com o Administrador.',
                401,
                $header,
                JSON_UNESCAPED_UNICODE
            );
        }

        $token = JWT::encode(['emailFornecedor' => $request->emailFornecedor], env('JWT_KEY'));

        return ['accessToken' => $token];
    }
}
