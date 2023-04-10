@section('main')
    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData['id']}}"></script>
    <form action="{{route('user.request.bankpay',['offer_id'=>$offer_id,'request_id'=>$request_id])}}" class="paymentWidgets" data-brands="VISA">
    </form>
@stop