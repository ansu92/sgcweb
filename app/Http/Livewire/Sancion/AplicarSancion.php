<?php

namespace App\Http\Livewire\Sancion;

use App\Models\AplicarSancion as ModelsAplicarSancion;
use App\Models\Sancion;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class AplicarSancion extends Component
{
    use WithPagination;

    public Unidad $unidad;
    public $sanciones = [];

    public $readyToLoad = false;

    public $busqueda = '';
    public $orden = 'numero';
    public $direccion = 'asc';
    public $cantidad = '10';

    public $open = false;

    public $selectPage = false;
    public $selectAll = false;

    protected $rules = [
        'sanciones' => 'array|min:1',
    ];

    public function getConsultaListaSancionesProperty()
    {
        return Sancion::orderBy('descripcion', 'asc');
    }

    public function getListaSancionesProperty()
    {
        return $this->consultaListaSanciones->paginate(10);
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->sanciones = $this->consultaListaSanciones->pluck('id')->map(fn ($id) => (string)$id);
        }

        $listaUnidades = Unidad::where('numero', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy($this->orden, $this->direccion)
            ->paginate($this->cantidad);

        $listaSanciones = $this->readyToLoad ? $this->listaSanciones : [];

        return view('livewire.sancion.aplicar-sancion', compact('listaUnidades', 'listaSanciones'));
    }

    public function mostrarForm($id)
    {
        $this->unidad = Unidad::find($id);

        $this->open = true;
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    public function updatingCantidad()
    {
        $this->resetPage();
    }

    public function updatedAsistentes()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        $this->sanciones = $value ? $this->listaSanciones->pluck('id')->map(fn ($id) => (string)$id) : [];
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

    public function save()
    {
        $this->validate();

        foreach ($this->sanciones as $item) {

            $item = Sancion::find($item);

            $sancion = ModelsAplicarSancion::create([
                'unidad_id' => $this->unidad->id,
                'sancion_id' => $item->id,
                'monto_pagar' => $item->monto,
            ]);

            $sancion->save();
        }

        $this->reset('open');

        $this->unidad = new Unidad;
        $this->reset('sanciones');

        $this->emit('alert', 'La unidad fue sancionada satisfactoriamente');
    }
}
