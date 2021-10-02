<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPropietario extends Model
{
	use HasFactory;

	protected $table = 'pagos_propietario';
	
	protected $fillable = [
		'descripcion',
		'monto',
		'fecha',
		'referencia',
		'forma_pago',
		'moneda',
		'tasa_cambio',
		'fondo_id',
		'unidad_id',
		'factura_id',
	];

	public function pagarFactura(bool $conCambio)
	{
		if ($conCambio) {
			if ($this->moneda == 'Bolívar') {
				$montoConvertido = $this->monto / $this->tasa_cambio;
			} else if ($this->moneda == 'Dólar') {
				$montoConvertido = $this->monto * $this->tasa_cambio;
			}

			$this->factura->pagar($montoConvertido);
		} else {

			$this->factura->pagar($this->monto);
		}

		$this->fondo->acreditar($this->monto);
	}

	public function factura() {
		return $this->belongsTo(Factura::class);
	}

	public function fondo() {
		return $this->belongsTo(Fondo::class);
	}

	public function unidad() {
		return $this->belongsTo(Unidad::class);
	}
}
