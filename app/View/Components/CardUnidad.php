<?php

namespace App\View\Components;

use App\Models\Integrante;
use App\Models\Unidad;
use Illuminate\View\Component;

class CardUnidad extends Component
{
	public Unidad $unidad;
	public Integrante $propietario;
	public int $numHabitantes = 0;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(Unidad $unidad)
	{
		$this->unidad = $unidad;

		if ($unidad->propietario) {
			$this->propietario = $unidad->propietario->integrante;

			$this->numHabitantes = $this->unidad->loadCount('integrantes')->integrantes_count;
		} else {
			$this->propietario = new Integrante;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.card-unidad');
	}
}
