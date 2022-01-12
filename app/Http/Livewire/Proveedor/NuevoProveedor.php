<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoProveedor extends Component
{
	use WithPagination;

	public $letra = 'V';
	public $documento;
	public $nombre;
	public $contacto;
	public $codigo = '0412';
	public $telefono;
	public $email;
	public $direccion;
	public $servicios = [];

	public $open = false;

	public $readyToLoad = false;

	public $busqueda;
	public $orden = 'nombre';
	public $direction = 'asc';
	public $cantidad = '10';

	public $selectAll = false;
	public $selectPage = false;

	protected function rules()
	{
		return [
			'letra' => 'required',
			'documento' => 'required|digits_between:6,8|unique:proveedores,documento,NULL,id,letra,' . $this->letra . ',deleted_at,NULL',
			'nombre' => 'required',
			'contacto' => 'required',
			'codigo' => 'nullable',
			'telefono' => 'nullable|digits:7',
			'email' => 'nullable|email|unique:proveedores',
			'direccion' => 'nullable',
			'servicios' => 'nullable',
		];
	}

	public function getConsultaListaServiciosProperty()
	{
		return Servicio::where('nombre', 'LIKE', '%' . $this->busqueda . '%')
			->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direction);
	}

	public function getListaServiciosProperty()
	{
		return $this->consultaListaServicios->paginate($this->cantidad);
	}

	public function render()
	{
		if ($this->selectAll) {
			$this->servicios = $this->getConsultaListaServiciosProperty()->pluck('id')->map(fn ($id) => (string)$id);
		}

		$listaServicios = $this->readyToLoad ?
			Servicio::where('nombre', 'LIKE', '%' . $this->busqueda . '%')
			->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direction)
			->paginate($this->cantidad) :
			[];

		return view('livewire.proveedor.nuevo-proveedor', compact('listaServicios'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedLetra()
	{
		$this->validateOnly('letra');
		$this->validateOnly('documento');
	}

	public function updatedNumeroDocumento()
	{
		$this->validateOnly('documento');
		$this->validateOnly('letra');
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad()
	{
		$this->resetPage();
	}

	public function updatedServicios()
	{
		$this->selectAll = false;
		$this->selectPage = false;
	}

	public function updatedSelectPage($value)
	{
		$this->servicios = $value ? $this->listaServicios->pluck('id')->map(fn ($id) => (string)$id) : [];
	}

	public function orden($orden)
	{
		if ($this->orden == $orden) {
			if ($this->direction == 'desc') {
				$this->direction = 'asc';
			} else {
				$this->direction = 'desc';
			}
		} else {
			$this->orden = $orden;
			$this->direction = 'asc';
		}
	}

	public function save()
	{
		$this->validate();

		$proveedor = Proveedor::withTrashed()
			->where('letra', $this->letra)
			->where('documento', $this->documento)->first();

		if ($proveedor === null) {

			$proveedor = Proveedor::create([
				'letra' => $this->letra,
				'documento' => $this->documento,
				'nombre' => $this->nombre,
				'contacto' => $this->contacto,
				'telefono' => $this->codigo . '-' . $this->telefono,
				'email' => $this->email,
				'direccion' => $this->direccion,
			]);
		} else {
			$proveedor->restore();

			$proveedor->nombre = $this->nombre;
			$proveedor->contacto = $this->contacto;
			$proveedor->telefono = $this->codigo . '-' . $this->telefono;
			$proveedor->email = $this->email;

			$proveedor->save();
		}

		$proveedor->servicios()->sync($this->servicios);

		$this->reset([
			'open',
			'letra',
			'documento',
			'nombre',
			'contacto',
			'codigo',
			'telefono',
			'email',
			'direccion',
			'servicios',
		]);

		$this->emitTo('proveedor.tabla-proveedor', 'render');
		toastr()->livewire()->addSuccess('El registro se creó satisfactoriamente');
	}
}
