<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethod extends Component
{

    public function addPaymentMethod($paymentMethod)
    {
        auth()->user()->addPaymentMethod($paymentMethod);
    }

    public function render()
    {
        return view('livewire.payment-method', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }
}
