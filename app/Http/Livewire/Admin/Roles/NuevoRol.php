<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NuevoRol extends Component
{
    public $nombre;
    public $permisos = [];

    public $open = false;

    protected $rules = [
        'nombre' => 'required|string|unique:roles,name',
        'permisos' => 'required|array|min:1',
    ];

    public function render()
    {
        return view('livewire.admin.roles.nuevo-rol');
    }

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

        $rol = Role::create([
            'name' => $this->nombre,
        ]);

        $rol->permissions()->sync($this->permisos);

        $this->reset([
			'open',
			'nombre',
			'permisos',
		]);

		$this->emitTo('admin.roles.tabla-rol', 'render');
		toastr()->livewire()->addSuccess('El registro se creó satisfactoriamente');
	}

    public function getListaPermisosProperty() {
        return Permission::orderBy('name', 'asc')->get();
    }
}
