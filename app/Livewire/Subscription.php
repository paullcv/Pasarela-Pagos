<?php

namespace App\Livewire;

use Livewire\Component;

class Subscription extends Component
{

    //propiedad computada para recuperar el metodo predetermindado
    //son funciones, pero podemos acceder como a propiedades
    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function newSubscription($plan)
    {
        //dd($plan);
        if (! $this->defaultPaymentMethod) {
            $this->emit('error','¡No tienes un método de pago por defecto!');

            return;
        }
        auth()->user()->newSubscription('Cuso Suscripciones',$plan)->create($this->defaultPaymentMethod->id);
    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
