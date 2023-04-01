<?php

namespace App\Resolvers;

use Exception;
use App\PaymentPlatform;

class PaymentPlatformResolver
{
    protected $paymentPlatforms;

    public function __construct()
    {
        $this->paymentPlatforms = PaymentPlatform::all();
        //dd($this->paymentPlatforms);
        
    }

    public function resolveService($paymentPlatformId)
    {
        //dd($paymentPlatformId);
        $name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name);
        //dd($name);

        $service = config("services.{$name}.class");

        
        if ($service) {
            return resolve($service);
        }

        throw new Exception('The selected payment platform is not in the configuration');
    }
}