<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TablaRol extends Component
{
    use WithPagination;

    public Role $rol;
    public $permisos = [];

    public $busqueda;
    public $orden = 'name';
    public $direccion = 'asc';
    public $cantidad = '10';

    public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $listeners = ['render'];

    protected function rules() {
        return [
            'rol.name' => [
                'required',
                'string',
                Rule::unique('roles', 'name')->ignore($this->rol),
            ]
        ];
    }

    protected $validationAttributes = [
        'rol.name' => 'nombre',
    ];

    public function mount() {
        $this->rol = new Role();
    }

    public function render()
    {
        $roles = Role::where('name', 'LIKE', "%{$this->busqueda}%")->orderBy($this->orden, $this->direccion)->paginate($this->cantidad);

        return view('livewire.admin.roles.tabla-rol', compact('roles'));
    }

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
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

	public function edit(Role $rol)
	{
		$this->rol = $rol;
        $this->permisos = $rol->permissions()->allRelatedIds()->map(fn ($id) => (string)$id);

		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

        $this->rol->permissions()->sync($this->permisos);
		$this->rol->save();

		$this->reset('openEdit');

		toastr()->livewire()->addSuccess('El rol se actualizó satisfactoriamente');
	}

	public function destroy(Role $rol)
	{
		$this->rol = $rol;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->rol->delete();

		$this->reset('openDestroy');

		toastr()->livewire()->addSuccess('El rol se eliminó satisfactoriamente');
	}

    public function getListaPermisosProperty() {
        return Permission::orderBy('name', 'asc')->get();
    }
}
