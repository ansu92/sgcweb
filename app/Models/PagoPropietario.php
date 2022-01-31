<?php

namespace App\Models;

use App\Traits\WithCurrencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPropietario extends Model
{
	use HasFactory;
	use WithCurrencies;

	protected $table = 'pagos_propietario';

	protected $fillable = [
		'descripcion',
		'monto',
		'fecha',
		'referencia',
		'forma_pago',
		'moneda',
		'tasa_cambio_id',
		'fondo_id',
		'unidad_id',
		'factura_id',
	];

	public function pagarFactura()
	{
		$conCambio = $this->moneda != $this->factura->moneda;

		if ($conCambio) {
			if ($this->moneda == 'Bolívar') {
				$montoConvertido = $this->monto / $this->tasa->tasa;
			} else if ($this->moneda == 'Dólar') {
				$montoConvertido = $this->monto * $this->tasa->tasa;
			}

			$this->factura->pagar($montoConvertido);
		} else {

			$this->factura->pagar($this->monto);
		}

		if ($this->fondo) {
			$this->fondo->acreditar($this->monto);
		}

		$this->estado = 'Confirmado';
		$this->save();
	}

	public function getMontoFormateadoAttribute() {
		return $this->formatearMonto($this->monto, $this->moneda);
	}

	public function aceptarPago()
	{
		$this->fondo->acreditar($this->monto);

		$this->estado = 'Confirmado';
		$this->save();
	}

	public function rechazar() {
		$this->estado = 'Rechazado';
		$this->save();
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function fondo()
	{
		return $this->belongsTo(Fondo::class);
	}

	public function unidad()
	{
		return $this->belongsTo(Unidad::class);
	}

	public function recibo()
	{
		return $this->hasOne(Recibo::class);
	}

	public function tasa() {
		return $this->belongsTo(TasaCambio::class, 'tasa_cambio_id');
	}
}
