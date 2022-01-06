<?php

namespace App\Http\Livewire\Admin\Permisos;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class NuevoPermiso extends Component
{
    public $nombre;

    public $open = false;

    protected $rules = [
        'nombre' => 'required|string|unique:permissions,name',
    ];

    public function render()
    {
        return view('livewire.admin.permisos.nuevo-permiso');
    }

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

        Permission::create([
            'name' => $this->nombre,
        ]);

        $this->reset([
			'open',
			'nombre',
		]);

		$this->emitTo('admin.permisos.tabla-permiso', 'render');
		toastr()->livewire()->addSuccess('El registro se creó satisfactoriamente');
	}
}
