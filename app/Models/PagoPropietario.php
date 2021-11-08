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

	public function pagarFactura()
	{
		$conCambio = $this->moneda != $this->factura->moneda;

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

		if ($this->cuenta) {

			if ($this->cuenta->fondo) {

				$this->fondo->acreditar($this->monto);
			}
		}

		$this->estado = 'Confirmado';
		$this->save();
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function cuenta()
	{
		return $this->belongsTo(Cuenta::class);
	}

	public function unidad()
	{
		return $this->belongsTo(Unidad::class);
	}

	public function recibo() {
		return $this->hasOne(Recibo::class);
	}
}
