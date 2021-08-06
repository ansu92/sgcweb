<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	use HasFactory;

	protected $table = 'pagos_gastos';

	protected $fillable = [
		'descripcion',
		'monto',
		'fecha',
		'recibo',
		'referencia',
		'forma_pago',
		'moneda',
		'tasa_cambio',
	];

	public function gasto()
	{
		return $this->belongsTo(Gasto::class);
	}

	public function fondo()
	{
		return $this->belongsTo(Fondo::class);
	}

	public function pagarGasto()
	{
		if ($this->moneda == $this->gasto->moneda) {
			$this->gasto->saldo = $this->gasto->saldo - $this->monto;
			$this->fondo->saldo = $this->fondo->saldo - $this->monto;
		} else {

			if ($this->moneda == 'Bolívar') {
				$montoConvertido = $this->monto / $this->tasaCambio;
			} else if ($this->moneda == 'Dólar') {
				$montoConvertido = $this->monto * $this->tasaCambio;
			}

			$this->gasto->saldo -= $montoConvertido;
			$this->fondo->saldo -= $this->monto;
		}

		$this->push();
	}
}
