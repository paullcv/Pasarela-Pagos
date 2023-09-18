<div>

    <section class="bg-white rounded shadow-lg">

        <div class="px-8 py-6">

            <h1 class="text-gray-700 text-lg font-semibold mb-4">Agregar metodo de pago</h1>

            <div class="flex" wire:ignore>

                <p class="text-gray-600 mr-6">Informacion de la targeta</p>

                <div class="flex-1">
                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la targeta">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control mb-2"></div>

                    <span id="card-error-message" class="text-red-500 text-sm"></span>
                </div>
            </div>
        </div>

        <footer class="px-8 py-6 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-end">
                <x-button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </x-button>
            </div>

        </footer>

    </section>


    @push('js')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                );

                if (error) {

                    let span = document.getElementById('card-error-message')

                    span.textContent = error.message;

                    console.log(error.message);
                } else {
                    @this.addPaymentMethod(setupIntent.payment_method);
                    console.log(setupIntent.payment_method);
                }
            });
        </script>
    @endpush
</div>