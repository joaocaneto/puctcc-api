<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProdutoFornecedor
 * 
 * @property int $p_idProduto
 * @property int $f_idFornecedor
 * 
 * @property \App\Models\Fornecedor $fornecedor
 * @property \App\Models\Produto $produto
 *
 * @package App\Models
 */
class ProdutoFornecedor extends Eloquent
{
	protected $table = 'produto_fornecedor';
	protected $primaryKey = 'idPF';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'p_idProduto' => 'int',
		'f_idFornecedor' => 'int',
		'quantidade' => 'int'
	];

	protected $fillable = [
		'p_idProduto',
		'f_idFornecedor',
		'quantidade'
	];

	public function fornecedor()
	{
		return $this->belongsTo(\App\Models\Fornecedor::class, 'fornecedor_idFornecedor');
	}

	public function produto()
	{
		return $this->belongsTo(\App\Models\Produto::class, 'produto_idProduto');
	}
}
