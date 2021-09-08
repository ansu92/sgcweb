<?php

namespace App\Http\Livewire\CierreMes;

use App\Models\Factura;
use App\Models\Gasto;
use App\Models\Unidad;
use Illuminate\Support\Facades\DB;
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

		$unidades = Unidad::all();

		$areaTotal = DB::table('unidades')
			->join('tipo_unidades', 'unidades.tipo_unidad_id', '=', 'tipo_unidades.id')
			->sum('area');

		foreach (Gasto::where('comienzo_cobro', $this->mes) as $gasto) {

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
					'fecha' => now(),
					'gasto_id' => $gasto->id,
					'unidad_id' => $unidad->id,
				]);
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
