<?php

namespace App\Http\Livewire\CierreMes;

use App\Models\Factura;
use App\Models\Gasto;
use App\Models\Item;
use App\Models\Mensualidad;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Collection;
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

		// Se obtienen todas las unidades que pertenezcan a un propietario
		$unidades = Unidad::has('propietario')->get();

		// Se calcula la suma del área de todas las unidades
		$areaTotal = Unidad::getAreaTotal();

		// Se obtienen los datos de la mensualidad del condominio
		$mensualidad = Mensualidad::orderBy('created_at', 'desc')->first();

		// Se crea el item de mensualidad de la factura, ya que será igual para todo
		$itemMensualidad = Item::make([
			'itemable_id' => $mensualidad->id,
			'itemable_type' => Mensualidad::class,
			'monto' => $mensualidad->monto,
		]);

		// Se obtienen todos los gastos ordinarios que se estén cobrando en el mes
		$gastosOrdinarios = Gasto::where('tipo', 'Ordinario')
			->where('mes_cobro', '<=', $this->mes)
			->where('estado_cobro', 'Pendiente')
			->orWhere('estado_cobro', 'En proceso')
			->get();

		// Se obtienen todos los gastos extraordinarios que se estén cobrando en el mes
		$gastosExtraordinarios = Gasto::where('tipo', 'Extraordinario')
			->where('mes_cobro', '<=', $this->mes)
			->where(function ($query) {
				$query->where('estado_cobro', 'Pendiente')
					->orWhere('estado_cobro', 'En proceso');
			})
			->get();

		foreach ($unidades as $unidad) {

			// Se genera una colección para los elementos de la factura
			$itemsFactura = new Collection();

			// Se agrela a la colección el item de la mensualidad creado anteriormente
			$itemsFactura->push($itemMensualidad);

			foreach ($gastosOrdinarios as $gasto) {

				// Se verifica el tipo de cálculo del gasto para calcular el monto
				if ($gasto->calculo_por == 'Total de inmuebles') {
					$monto = $gasto->monto / $unidades->count();
				} else if ($gasto->calculo_por == 'Alícuota') {

					$alicuota = $unidad->tipoUnidad->area / $areaTotal;

					$monto = $gasto->monto * $alicuota;
				}

				// Se crea el item para la factura
				$item = Item::make([
					'itemable_id' => $gasto->id,
					'itemable_type' => Gasto::class,
					'monto' => $gasto->monto,
				]);

				// Se agrega el item a la colección
				$itemsFactura->push($item);

				// Se cambia el estado del gasto para indicar que está en proceso de cobro
				$gasto->estado_cobro = 'En proceso';
				$gasto->save();
			}

			foreach ($gastosExtraordinarios as $gasto) {

				if ($gasto->getFechaFin() >= $this->mes) {

					// Se verifica el tipo de cálculo del gasto para calcular el monto
					if ($gasto->calculo_por == 'Total de inmuebles') {
						$monto = $gasto->monto / $unidades->count();
					} else if ($gasto->calculo_por == 'Alícuota') {
						$alicuota = $unidad->tipoUnidad->area / $areaTotal;

						$monto = $gasto->monto * $alicuota;
					}

					// Se crea el item para la factura
					$item = Item::make([
						'itemable_id' => $gasto->id,
						'item_type' => Gasto::class,
						'monto' => $monto,
					]);

					// Se agrega el item a la colección
					$itemsFactura->push($item);

					// Se cambia el estado del gasto para indicar que está en proceso de cobro
					$gasto->estado_cobro = 'En proceso';
					$gasto->save();
				}
			}

			foreach ($unidad->sanciones as $item) {

				// Se crea el item para la factura
				$item = Item::make([
					'itemable_id' => $item->id,
					'item_type' => Sancion::class,
					'monto' => $item->monto,
				]);

				// Se agrega el item a la colección
				$itemsFactura->push($item);
			}

			// Se crea una variable para almacenar el monto total de la factura
			$montoFactura = 0;

			// Se suma el monto de todos los items
			foreach ($itemsFactura as $item) {
				$montoFactura += $item->monto;
			}

			// Se crea la factura
			Factura::create([
				'monto' => $montoFactura,
				'monto_por_pagar' => $montoFactura,
				'moneda' => $this->moneda,
				'fecha' => now(),
				'unidad_id' => $unidad->id,
			]);

			// Se guardan los items en la base de datos
			foreach ($itemsFactura as $item) {
				$item->save();
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
