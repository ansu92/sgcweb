<?php

namespace App\Http\Livewire\Banco;

use App\Models\Banco;
use Livewire\Component;
use Livewire\WithPagination;

class TablaBanco extends Component
{
    use WithPagination;

    public $banco;

    public $busqueda;
    public $orden = 'nombre';
    public $direccion = "asc";
    public $cantidad = "10";

    protected $listeners = ['render'];

    public $readyToLoad = false;

    public $openEdit = false;
    public $openDestroy = false;

    protected $rules = [
        'banco.nombre' => 'required|max:60',
    ];

    public function mount()
    {
        $this->banco = new Banco;
    }

    public function render()
    {

        if ($this->readyToLoad) {

            $bancos = Banco::where('nombre', 'like', '%' . $this->busqueda . '%')
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $bancos = [];
        }
        return view('livewire.banco.tabla-banco', compact('bancos'));
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

    public function edit(Banco $banco)
    {
        $this->banco = $banco;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->banco->save();
        $this->reset('openEdit');
        toastr()->livewire()->addSuccess('El banco se actualizó satisfactoriamente');
    }

    public function destroy(Banco $banco)
    {
        $this->banco = $banco;
        $this->openDestroy = true;
    }

    public function delete()
    {
        $this->banco->delete();
        $this->reset('openDestroy');
        toastr()->livewire()->addSuccess('El banco se eliminó satisfactoriamente');
    }
}
