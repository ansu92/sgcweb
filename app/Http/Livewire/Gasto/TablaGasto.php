<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Gasto;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class TablaGasto extends Component
{
	use WithPagination;

	public $busqueda;
	public $orden = 'created_at';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $readyToLoadEdit = false;

	public $openCancelar = false;

	public Gasto $gasto;
	public $montos = [];

	protected $listeners = ['render'];

	protected $rules = [
		'gasto.monto' => '',
	];

	public function mount()
	{
		$this->gasto = new Gasto;
		$this->gasto->proveedor = new Proveedor;
	}

	public function render()
	{
		$gastos = $this->readyToLoad ?
			Gasto::where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad) :
			[];

		return view('livewire.gasto.tabla-gasto', compact('gastos'));
	}

	public function updatingMontos()
	{
		$this->gasto->monto = 0;
	}

	public function updatedMontos()
	{
		$this->sumarMontos();
	}

	private function sumarMontos()
	{
		foreach ($this->montos as $key => $monto) {

			if ($monto != "") {

				if (in_array($key, $this->gasto->servicios->pluck('id')->toArray())) {
					$this->gasto->monto += $monto;
				}
			}
		}

		number_format($this->gasto->monto, 2, ',', '.');
	}

	public function edit(Gasto $gasto)
	{
		foreach ($gasto->servicios as $item) {
			$this->montos[$item->id] = $item->pivot->monto;
		}

		$this->gasto = $gasto;
		$this->gasto->proveedor;
		$this->readyToLoadEdit = true;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		foreach ($this->gasto->servicios as $item) {
			$item->pivot->monto = $this->montos[$item->id];
			$item->pivot->save();
		}

		if ($this->gasto->save()) {
			$this->reset('openEdit');

			toastr()->livewire()->addSuccess('El gasto fue actualizado satisfactoriamente');
		}
	}

	public function cancelar(Gasto $gasto)
	{
		$this->gasto = $gasto;
		$this->openCancelar = true;
	}

	public function delete()
	{
		if ($this->gasto->delete()) {
			$this->reset('openCancelar');

			toastr()->livewire()->addSuccess('El gasto fue detenido satisfactoriamente');
		}
	}
}
