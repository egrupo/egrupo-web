<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desafio extends Model {
    
    protected $fillable = [
			'titulo','divisao','descricao','etapa'
		];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'desafios';
}
