<?php

namespace App\Http\Livewire\Cuenta;

use App\Models\Banco;
use App\Models\Cuenta;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TablaCuenta extends Component
{

	use WithPagination;

	public $cuenta;

	public $codigo = '0412';
	public $telefono;

	public $busqueda;
	public $orden = 'numero';
	public $direccion = "desc";
	public $cantidad = "10";

	protected $listeners = ['render'];

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	public $bancos = [];

	public $letra = 'V', $documento;

	protected $rules = [
		'letra' => 'required',
		'documento' => 'required|min:6|max:10',
		'cuenta.beneficiario' => 'required|string|max:45',
		'cuenta.numero' => 'required|numeric|digits:20',
		'cuenta.banco_id' => 'required|not_in:0',
		'cuenta.tipo' => 'required|not_in:0',
		'codigo' => 'nullable',
		'telefono' => 'nullable|digits:7',
		'cuenta.publica' => 'boolean',
	];

	public function mount()
	{
		$this->cuenta = new Cuenta;
	}

	public function render()
	{
		if ($this->readyToLoad) {

			$cuentas = Cuenta::where('numero', 'like', '%' . $this->busqueda . '%')
				->orwhere('tipo', 'like', '%' . $this->busqueda . '%')
				->orwhere('documento', 'like', '%' . $this->busqueda . '%')
				->orwhere('beneficiario', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$cuentas = [];
		}

		return view('livewire.cuenta.tabla-cuenta', compact('cuentas'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function loadCuentas()
	{

		$this->readyToLoad = true;
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad()
	{
		$this->resetPage();
	}

	public function orden($orden)
	{
		if ($this->orden == $orden) {
			if ($this->direccion == 'desc') {
				$this->direccion = 'asc';
			} else {
				$this->direccion = 'desc';
			}
		} else {
			$this->orden = $orden;
			$this->direccion = 'asc';
		}
	}

	public function edit(Cuenta $cuenta)
	{

		$this->letra = Str::substr($cuenta->documento, 0, 1);
		$this->documento = Str::substr($cuenta->documento, 2);

		$this->codigo = Str::substr($cuenta->telefono, 0, 4);
		$this->telefono = Str::substr($cuenta->telefono, 5, 7);

		$this->bancos = Banco::all();
		$this->cuenta = $cuenta;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->cuenta->documento = $this->letra . '-' . $this->documento;

		$this->validate();

		if ($this->telefono) {
			$this->telefono = $this->codigo . '-' . $this->telefono;
		}

		$this->cuenta->save();

		$this->reset('openEdit');

		$this->emit('alert', 'La cuenta se actualizó satisfactoriamente');
	}

	public function destroy(Cuenta $cuenta)
	{
		$this->cuenta = $cuenta;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->cuenta->delete();

		$this->reset('openDestroy');

		$this->emit('alert', 'La cuenta se eliminó satisfactoriamente');
	}
}
