<?php

namespace App\Observers;

use App\Models\Comunicado;
use Illuminate\Support\Facades\Auth;

class ComunicadoObserver
{
	/**
	 * Handle the Comunicado "created" event.
	 *
	 * @param  \App\Models\Comunicado  $comunicado
	 * @return void
	 */
	public function creating(Comunicado $comunicado)
	{
		if (!\App::runningInConsole()) {
			$comunicado->autor()->associate(Auth::user()->administrador);
		}
	}

	/**
	 * Handle the Comunicado "updated" event.
	 *
	 * @param  \App\Models\Comunicado  $comunicado
	 * @return void
	 */
	public function updated(Comunicado $comunicado)
	{
		//
	}

	/**
	 * Handle the Comunicado "deleted" event.
	 *
	 * @param  \App\Models\Comunicado  $comunicado
	 * @return void
	 */
	public function deleted(Comunicado $comunicado)
	{
		//
	}

	/**
	 * Handle the Comunicado "restored" event.
	 *
	 * @param  \App\Models\Comunicado  $comunicado
	 * @return void
	 */
	public function restored(Comunicado $comunicado)
	{
		//
	}

	/**
	 * Handle the Comunicado "force deleted" event.
	 *
	 * @param  \App\Models\Comunicado  $comunicado
	 * @return void
	 */
	public function forceDeleted(Comunicado $comunicado)
	{
		//
	}
}
