<?php

namespace App\Traits;

use NumberFormatter;

trait WithCurrencies
{
    public function formatearMonto($monto, $moneda)
    {
        $formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);
        $bolivar = 'VES';
        $dolar = 'USD';

        if ($moneda == 'Bolívar') {
            $montoFormateado = $formatoDinero->formatCurrency($monto, $bolivar);
        } else if ($moneda == 'Dólar') {
            $montoFormateado = $formatoDinero->formatCurrency($monto, $dolar);
        }

        return $montoFormateado;
    }
}
