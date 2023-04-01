<?php

use App\Currency;
use App\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPlatform::create([
            'name'=>'PayPal',
            'image'=>'imagenes/payment-platforms/paypal.jpg'
        ]);

        PaymentPlatform::create([
            'name'=>'Stripe',
            'image'=>'imagenes/payment-platforms/stripe.jpg'
        ]);

        PaymentPlatform::create([
            'name'=>'Transferencia',
            'image'=>'imagenes/payment-platforms/payu.jpg'
        ]);
    }
}
