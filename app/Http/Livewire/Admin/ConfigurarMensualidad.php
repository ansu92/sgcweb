<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensualidad;
use Livewire\Component;

class ConfigurarMensualidad extends Component
{
	public $monto;
	public $moneda = 'Bolívar';

	public $open = false;

	public $busqueda = '';
	public $orden = 'created_at';
	public $direccion = 'desc';
	public $cantidad = '10';

	protected $rules = [
		'monto' => 'required|numeric|gt:0',
		'moneda' => 'required',
	];

	public function mount()
	{
		$this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
		$this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;
	}

    public function render()
    {
		$mensualidades = Mensualidad::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

        return view('livewire.admin.configurar-mensualidad', compact('mensualidades'));
    }

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function actualizar()
	{
		$this->validate();

		Mensualidad::create([
			'monto' => $this->monto,
			'moneda' => $this->moneda,
		]);

		$this->reset('open');

		$this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
		$this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;

		toastr()->livewire()->addSuccess('La mensaulidad fue actualizada con éxito');
	}
}
