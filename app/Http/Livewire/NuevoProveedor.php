<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoProveedor extends Component
{
	use WithPagination;

	public $letra = 'V', $documento, $nombre, $contacto, $telefono, $email, $direccion, $servicios = [];

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
			'telefono' => 'required|regex:/\d{4}-\d{7}/',
			'email' => 'nullable|email|unique:proveedores',
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
		if($this->selectAll) {
			$this->servicios = $this->getConsultaListaServiciosProperty()->pluck('id')->map(fn ($id) => (string)$id);
		}

		$listaServicios = $this->readyToLoad ?
			Servicio::where('nombre', 'LIKE', '%' . $this->busqueda . '%')
			->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direction)
			->paginate($this->cantidad) :
			[];

		return view('livewire.nuevo-proveedor', compact('listaServicios'));
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

			Proveedor::create([
				'letra' => $this->letra,
				'documento' => $this->documento,
				'nombre' => $this->nombre,
				'contacto' => $this->contacto,
				'telefono' => $this->telefono,
				'email' => $this->email,
				'direccion' => $this->direccion,
			]);
		} else {
			$proveedor->restore();

			$proveedor->letra = $this->letra;
			$proveedor->documento = $this->documento;
			$proveedor->nombre = $this->nombre;
			$proveedor->contacto = $this->contacto;
			$proveedor->telefono = $this->telefono;
			$proveedor->email = $this->email;

			$proveedor->save();
		}

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

		$this->emitTo('tabla-proveedor', 'render');
		$this->emit('alert', 'El registro se creó satisfactoriamente');
	}
}
