<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use App\Services\CurrencyConversionService;
use RealRashid\SweetAlert\Facades\Alert;
use MercadoPago;

class MercadoPagoService
{
    

    public function handlePayment(Request $request)
    {
        // SDK de Mercado Pago
        require  base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75;
        $preference->items = array($item);
        $preference->save();

        //return redirect()->route('reservar');
    }

    
}