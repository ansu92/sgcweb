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

	public function pagarGasto(bool $conCambio)
	{
		$this->fondo->debitar($this->monto);

		if ($conCambio) {
			if ($this->moneda == 'Bolívar') {
				$montoConvertido = $this->monto / $this->tasa_cambio;
			} else if ($this->moneda == 'Dólar') {
				$montoConvertido = $this->monto * $this->tasa_cambio;
			}

			$this->gasto->pagar($montoConvertido);
		} else {

			$this->gasto->pagar($this->monto);
		}
	}
}
