<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ReservaStoreRequest;
use App\Resolvers\PaymentPlatformResolver;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver){
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    public function pay(Request $request){
        //dd("hola");
        //dd($request->all());
        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);
        
        session()->put('paymentPlatformId',$request->payment_platform);

        return $paymentPlatform->handlePayment($request);
    }

    public function approval()
    {
        $lang = app()->getLocale();

        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }

        if ( $lang == "es"){
            Alert::error('Error', "No pudimos recibir la plataforma de pago. Intenta nuevamente.")->autoClose(5000);
            return redirect()->route('inicio');
        }else{
            Alert::error('Error', "ITALIA. No pudimos recibir la plataforma de pago. Intenta nuevamente.")->autoClose(5000);
            return redirect()->route('inicio');
        }

        // return redirect()
        //     ->route('home')
        //     ->withErrors('We cannot retrieve your payment platform. Try again, plase.');
    }

    public function cancelled()
    {
        $lang = app()->getLocale();

        if ( $lang == "es"){
            Alert::error('Error', "Has cancelado el pago")->autoClose(5000);
            return redirect()->route('reservar');
        }else{
            Alert::error('Error', "ITALIA. Has cancelado el pago")->autoClose(5000);
            return redirect()->route('reservar');
        }


    }
}
