<?php

namespace App\Http\Livewire\Medicamento;

use App\Models\Medicamento;
use Livewire\Component;
use Livewire\WithPagination;

class TablaMedicamento extends Component
{
    use WithPagination;

    public Medicamento $medicamento;

    public $busqueda = '';
    public $orden = 'nombre';
    public $direccion = "asc";
    public $cantidad = '10';

    public $readyToLoad = false;

    public $openEdit = false;
    public $openDestroy = false;

    protected $rules = [
        'medicamento.nombre' => 'required|max:25',
        'medicamento.descripcion' => 'max:255',
    ];

    protected $listeners = ['render'];

    public function render()
    {
        if ($this->readyToLoad) {
            $medicamentos = Medicamento::where('nombre', 'like', '%' . $this->busqueda . '%')
                ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $medicamentos = [];
        }

        return view('livewire.medicamento.tabla-medicamento', compact('medicamentos'));
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

    public function edit(Medicamento $medicamento)
    {
        $this->medicamento = $medicamento;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->medicamento->save();

        $this->reset('openEdit');

        $this->emitTo('medicamento.tabla-medicamento', 'render');
        $this->emit('alert', 'El medicamento se actualizó satisfactoriamente');
    }

    public function destroy(Medicamento $medicamento)
    {
        $this->medicamento = $medicamento;
        $this->openDestroy = true;
    }

    public function delete()
    {
        $this->medicamento->delete();

        $this->reset('openDestroy');

        $this->emitTo('medicamento.tabla-medicamento', 'render');
        $this->emit('alert', 'El medicamento se eliminó satisfactoriamente');
    }
}
