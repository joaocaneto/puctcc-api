<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Produto
 *
 * @property int $idProduto
 * @property string $nomeProduto
 * @property string $descProduto
 * @property float $preco
 * @property string $situacao
 * @property string $categoria
 *
 * @property \Illuminate\Database\Eloquent\Collection $fornecedors
 *
 * @package App\Models
 */
class Produto extends Eloquent
{
	protected $table = 'produto';
	protected $primaryKey = 'idProduto';
	public $timestamps = false;

	protected $casts = [
		'preco' => 'float'
	];

	protected $fillable = [
		'nomeProduto',
		'descProduto',
		'preco',
        'situacao',
        'categoria'
	];

	public function fornecedors()
	{
		return $this->belongsToMany(\App\Models\Fornecedor::class, 'produto_fornecedor', 'produto_idProduto', 'fornecedor_idFornecedor');
	}
}
