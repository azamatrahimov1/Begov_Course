<form action="{{ route('checkout.store', $online->id) }}" method="POST">
    @csrf
    <div class="mt-4">
        <x-input-label for="order_id" :value="__('Kurs narxi')" />

        <x-text-input id="order_id" class="block mt-1 w-full"
                      type="hidden" value="{{ $online->price }}"
                      name="amount" />
        <x-primary-button class="ms-4">
            {{ __('To\'lash') }}
        </x-primary-button>

        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
    </div>
</form>
