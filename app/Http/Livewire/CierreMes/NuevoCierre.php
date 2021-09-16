<?php

namespace App\Http\Livewire\CierreMes;

use App\Models\Factura;
use App\Models\Gasto;
use App\Models\Unidad;
use Livewire\Component;

class NuevoCierre extends Component
{
	public $mes;
	public $moneda = 'Bolívar';
	public $tasaCambio;

	public $open = false;

	public $readyToLoad = false;

	protected $rules = [
		'mes' => 'required|before_or_equal:this month',
		'moneda' => 'required',
		'tasaCambio' => 'required|numeric|gt:0',
	];

	protected $messages = [
		'mes.before_or_equal' => 'El mes debe ser anterior o igual a este mes.',
	];

	public function render()
	{
		return view('livewire.cierre-mes.nuevo-cierre');
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function cerrarMes()
	{
		$this->validate();

		$unidades = Unidad::has('propietario')->get();

		$areaTotal = Unidad::getAreaTotal();

		$gastosOrdinarios = Gasto::where('tipo', 'Ordinario')
			->where('mes_cobro', '<=', $this->mes)
			->where('estado_cobro', 'Pendiente')
			->orWhere('estado_cobro', 'En proceso')
			->get();

		$gastosExtraordinarios = Gasto::where('tipo', 'Extraordinario')
			->where('mes_cobro', '<=', $this->mes)
			->where('estado_cobro', 'Pendiente')
			->orWhere('estado_cobro', 'En proceso')
			->get();

		foreach ($gastosOrdinarios as $gasto) {

			foreach ($unidades as $unidad) {

				if ($gasto->calculo_por == 'Total de inmuebles') {
					$monto = $gasto->monto / $unidades->count();
				} else if ($gasto->calculo_por == 'Alícuota') {

					$alicuota = $unidad->tipoUnidad->area / $areaTotal;

					$monto = $gasto->monto * $alicuota;
				}

				Factura::create([
					'monto' => $monto,
					'monto_por_pagar' => $monto,
					'moneda' => $this->moneda,
					'tasa_cambio' => $this->tasaCambio,
					'fecha' => now(),
					'gasto_id' => $gasto->id,
					'unidad_id' => $unidad->id,
				]);

				$gasto->estado_cobro = 'En proceso';
				$gasto->save();
			}
		}

		foreach ($gastosExtraordinarios as $gasto) {

			if ($gasto->getFechaFin() >= $this->mes) {

				foreach ($unidades as $unidad) {

					if ($gasto->calculo_por == 'Total de inmuebles') {
						$monto = $gasto->monto / $unidades->count();
					} else if ($gasto->calculo_por == 'Alícuota') {
						$alicuota = $unidad->tipoUnidad->area / $areaTotal;

						$monto = $gasto->monto * $alicuota;
					}

					Factura::create([
						'monto' => $monto,
						'monto_por_pagar' => $monto,
						'moneda' => $this->moneda,
						'tasa_cambio' => $this->tasaCambio,
						'fecha' => now(),
						'gasto_id' => $gasto->id,
						'unidad_id' => $unidad->id,
					]);

					$gasto->estado_cobro = 'En proceso';
					$gasto->save();
				}
			}
		}

		$this->reset([
			'open',
			'mes',
			'moneda',
			'tasaCambio',
		]);

		$this->emitTo('cierre-mes.tabla-factura', 'render');
		$this->emit('alert', 'El cierre de mes fue satisfactorio');
	}
}
