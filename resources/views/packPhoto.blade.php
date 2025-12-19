@extends('layouts.app')


@section('content')
    <div class="container">
        <div style="text-align: center"><h1>Acheter votre pack pour {{$tarif}}&nbsp;€ </h1></div>
        <div class="my-3" style="text-align: center">( 2.50 € par photos. Pour + de 10 photos, le tarif bloqué à 25 € )</div>
        <div style="text-align: center"><article></article></div>
        <div style="text-align: center">
            @foreach($photos as $photo)
                <img class="my-1 mx-1" src="/{{$photo->name_notbuy}}" style="height: 30vh">
            @endforeach
        </div>
    </div>

@endsection



@section('js')


    <script
    src="https://www.paypal.com/sdk/js?currency=EUR&client-id=Ab3qyBmnJmJ8ruOvwiSKfalytsUAZnWStWRFB8LBXFRsmzbreszhabhLSxUXuhOUGsgH8zgmPle-vseT"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>

    <script>

         $( document ).ready(function() {

             var coucou = 300
             var tempon = 0
             paypal.Buttons({

                 createOrder: async function (data, actions) {
                     // This function sets up the details of the transaction, including the amount and line item details.
                     return actions.order.create({
                         purchase_units: [{
                             amount: {
                                 value: {{$tarif}},
                             }
                         }]
                     });
                 },
                 onApprove: function (data, actions) {
                     // This function captures the funds from the transaction.
                     return actions.order.capture().then(function (details) {
                         // This function shows a transaction success message to your buyer.
                         $.ajax(
                             {
                                 type: "POST",
                                 url: "/paiement-ajax-pack",
                                 data: {
                                     details: details,
                                     pack_id: {{$pack_id}},
                                     tarif : {{$tarif}}
                                 },
                                 headers: {
                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                 },
                                 success: function (result) {
                                      window.location.href = '/history'


                                 }
                             }
                         )
                     });
                 }
             }).render("article");
         });
    // This function displays Smart Payment Buttons on your web page.
  </script>

@endsection
