<?php

namespace App\Models;

use App\Traits\WithCurrencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
	use WithCurrencies;

	protected $fillable = [
		'numero',
		'monto',
		'monto_por_pagar',
		'moneda',
		'fecha',
		'unidad_id',
		'iva_id',
		'interes_id',
		'tasa_cambio_id',
		'cierre_mes_id',
	];

	protected $casts = [
		'monto' => 'decimal:2',
		'monto_por_pagar' => 'decimal:2',
	];

	public function pagar(float $monto)
	{
		$this->monto_por_pagar -= $monto;

		if ($this->monto_por_pagar == 0) {
			$this->estado = 'Pagada';
		}

		$this->save();
	}

	public function revertirIva()
	{
		$this->monto = $this->monto / (($this->iva->factor / 100) + 1);
	}

	public function getMontoFormateadoAttribute() {
		return $this->formatearMonto($this->monto, $this->moneda);
	}

	public function getMontoPorPagarFormateadoAttribute() {
		return $this->formatearMonto($this->monto_por_pagar, $this->moneda);
	}

	public function items() {
		return $this->hasMany(Item::class);
	}

	public function unidad() {
		return $this->belongsTo(Unidad::class);
	}

	public function iva() {
		return $this->belongsTo(Iva::class);
	}

	public function interes() {
		return $this->belongsTo(Interes::class);
	}

	public function tasa() {
		return $this->belongsTo(TasaCambio::class);
	}
}
