<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;

class NuevoProveedor extends Component
{
	public $open = false;

	public $letra = 'V', $documento, $nombre, $contacto, $telefono, $email, $direccion;
	public $codigo, $numeroTelefono;

	protected function rules()
	{
		return [
			'letra' => 'required',
			'documento' => 'required|digits_between:6,8|unique:proveedores,documento,NULL,id,letra,' . $this->letra . ',deleted_at,NULL',
			'nombre' => 'required',
			'contacto' => 'required',
			'codigo' => 'required|not_in:0',
			'numeroTelefono' => 'required|digits:7',
			'email' => 'nullable|email|unique:proveedores',
		];
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

	public function save()
	{
		$this->validate();

		$this->telefono = $this->codigo . '-' . $this->numeroTelefono;

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
			'numeroTelefono',
			'email',
			'direccion',
		]);

		$this->emitTo('tabla-proveedor', 'render');
		$this->emit('alert', 'El registro se creó satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.nuevo-proveedor');
	}
}
