<x-guest-layout>
    <form method="POST" action="https://test.paycom.uz">

        <input type="hidden" name="merchant" value="{Merchant ID}"/>


        <input type="hidden" name="amount" value="{{ $order->price }}"/>

        <input type="hidden" name="account[order_id]" value="{{ $order->id }}"/>

        <button type="submit">Оплатить с помощью <b>Payme</b></button>
    </form>
</x-guest-layout>
