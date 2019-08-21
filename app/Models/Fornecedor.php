<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Fornecedor
 *
 * @property int $idFornecedor
 * @property string $cnpj
 * @property string $nomeFornecedor
 * @property string $descFornecedor
 * @property string $emailFornecedor
 * @property string $password
 * @property string $situacao
 *
 * @property \Illuminate\Database\Eloquent\Collection $produtos
 *
 * @package App\Models
 */
class Fornecedor extends Eloquent
{
	protected $table = 'fornecedor';
	protected $primaryKey = 'idFornecedor';
	public $timestamps = false;

	protected $fillable = [
        'cnpj',
		'nomeFornecedor',
        'descFornecedor',
		'emailFornecedor',
		'password',
		'situacao'
	];

	public function produtos()
	{
		return $this->belongsToMany(\App\Models\Produto::class, 'produto_fornecedor', 'fornecedor_idFornecedor', 'produto_idProduto');
	}
}