@php
    
    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 75;
    $preference->items = array($item);
    $preference->save();
   

@endphp

<label class="mt-3 mb-3">Payment via MercadoPago</label>
<button type="button" class="btn btn-info" onclick="checkout.open()" >  Pagar </button>


@push('scripts')

<script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
    const formmp = document.getElementById('paymentForm');
    const payButtonn = document.getElementById('toggler');

    payButtonn.addEventListener('click', async(e) => {
        
        if (form.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
            document.getElementById("payButton").hidden = true;
        }
    });


    
    // Agrega credenciales de SDK
    const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
      locale: "es-AR",
    });

    const checkout = mp.checkout({
        preference: {
        id: '{{ $preference->id }}',
        },
    });
    
  
    
</script>
  

@endpush