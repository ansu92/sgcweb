<?php

namespace App\Http\Livewire\Enfermedad;

use App\Models\Enfermedad;
use Livewire\Component;
use Livewire\WithPagination;

class TablaEnfermedad extends Component
{
    use WithPagination;

    public Enfermedad $enfermedad;

    public $busqueda = '';
    public $orden = 'nombre';
    public $direccion = "asc";
    public $cantidad = '10';

    public $readyToLoad = false;

    public $openEdit = false;
    public $openDestroy = false;

    protected $rules = [
        'enfermedad.nombre' => 'required|max:25',
        'enfermedad.descripcion' => 'max:255',
    ];

    protected $listeners = ['render'];

    public function render()
    {
        if ($this->readyToLoad) {
            $enfermedades = Enfermedad::where('nombre', 'like', '%' . $this->busqueda . '%')
                ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $enfermedades = [];
        }

        return view('livewire.enfermedad.tabla-enfermedad', compact('enfermedades'));
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

    public function edit(Enfermedad $enfermedad)
    {
        $this->enfermedad = $enfermedad;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->enfermedad->save();

        $this->reset('openEdit');

        $this->emitTo('enfermedad.tabla-enfermedad', 'render');
        $this->emit('alert', 'La enfermedad se actualizó satisfactoriamente');
    }

    public function destroy(Enfermedad $enfermedad)
    {
        $this->enfermedad = $enfermedad;
        $this->openDestroy = true;
    }

    public function delete()
    {
        $this->enfermedad->delete();

        $this->reset('openDestroy');

        $this->emitTo('enfermedad.tabla-enfermedad', 'render');
        $this->emit('alert', 'La enfermedad se eliminó satisfactoriamente');
    }
}
