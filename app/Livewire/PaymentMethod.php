<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethod extends Component
{

    //propiedad computada para recuperar el metodo predetermindado
    //son funciones, pero podemos acceder como a propiedades
    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }


    public function addPaymentMethod($paymentMethod)
    {
        auth()->user()->addPaymentMethod($paymentMethod);
          
        if (!auth()->user()->hasDefaultPaymentMethod()) {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }
    }

    public function deletePaymentMethod($paymentMethod)
    {
        //dd($paymentMethod);
        auth()->user()->deletePaymentMethod($paymentMethod);
    }

    public function defaultPaymentMethod($paymentMethod)
    {
        //dd($paymentMethod);
        auth()->user()->updateDefaultPaymentMethod($paymentMethod);
    }

    public function render()
    {
        return view('livewire.payment-method', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }
}
