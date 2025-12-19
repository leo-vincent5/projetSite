@extends("layouts.app")



@section('css')
       <link rel="stylesheet" href="css/paypal.css">
@endsection

@section("content")

    <div class="container">
        <div style="text-align: center"><h2>Votre panier </h2></div>

        @if(count($packs) > 0)
            <h2 class="my-5">Mes packs </h2>
        <div id="paypalDiv"></div>
            <ul id="listPack" class="list-group">
                @foreach($packs as $pack)
                    <li style="    display: flex;
    flex-direction: row;
    flex-wrap: wrap;

    justify-content: space-between;
    align-items: center;" id="pack_{{$pack->id}}"  class="list-group-item" > <img style="width: 50px;" src="/{{$pack->preview}}"> <h4>Pack avec {{$pack->nbphotos}} photos</h4> <div> <a href="{{$pack->cle}}"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg></button></a> <a href="{{route('paiementPack',['id' => $pack->id])}}"><button class="btn btn-success mx-2">Finaliser l'achat</button></a><button data-id="{{$pack->id}}" class="deletepack btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button></div> </li>
                @endforeach
            </ul>

        @endif

        <h2 class="my-5">Mes photos à l'unité </h2>

        Vous avez actuellement dans votre panier <b> <span id="countPanier">{{count($paniers)}}</span> @if(count($paniers) > 1)&nbsp;photos @else photo @endif </b> pour un montant de <b> <span id="prixPanier">{{ count($paniers)*3 }}</span>&nbsp;€</b>
        <br><div id="paypalButton"></div>
        <article></article>
        <a href="{{route('history')}}"><button class="btn btn-success">Voir vos photos achetées</button></a><button id="deletePanier" class="ml-2 btn btn-danger">Vider votre panier</button><a href="{{route('gallery')}}"><button class="ml-2 btn btn-warning">Voir d'autres photos</button></a><a href="{{route('codePromo')}}"><button class="ml-2 btn btn-primary">Utiliser un code promo</button></a>
        <ul id="list" class="list-group">
            @foreach($paniers as $panier)
                <li style="    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    align-content: flex-start;
    justify-content: space-between;
    align-items: center;" class="list-group-item"><img style="width: auto; max-height: 300px;" src="/{{$panier->photo()->first()->name_notbuy}}"><button data-id="{{$panier->id}}" class="btn btn-danger deletePanier"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button></li>
            @endforeach
        </ul>


        <button id="acheter" type="button" class="d-none btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Merci de votre achat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div style="display: flex;
    flex-direction: column;
    justify-content: space-around;
    flex-wrap: wrap;

    align-items: center;">
              <div id="paypal-boutons"></div>
              <img src="/img/reverence.gif">
              <p style="text-align: center">Merci beaucoup pour votre achat ! Vous contribuez à un reve ! <br>J'espere que vos photos vous plaierons !<br> ~ Léo  </p>
          </div>

      </div>
      <div class="modal-footer" style="    justify-content: center;">
          <a href="{{route("gallery")}}"><button type="button" class="btn btn-danger">Revenir aux choix des photos</button></a>
        <a href="{{route("history")}}"><button type="button" class="btn btn-primary">Voir mes photos achetées</button></a>
      </div>
    </div>
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


			                       await $.ajax(
				                       {
					                       type: "POST",
					                       url: "/getPanier",

					                       headers: {
						                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					                       },
					                       success: await function (result) {
						                       console.log(result)
						                       coucou = result['count']
						                       tempon = result['id_tempon']
					                       }
				                       }
			                       )
			                       //alert("{{count($paniers)*3 }}.00")
			                       // This function sets up the details of the transaction, including the amount and line item details.
			                       return actions.order.create({
				                                                   purchase_units: [
					                                                   {
						                                                   amount: {
							                                                   value: coucou * 3,
						                                                   }
					                                                   }
				                                                   ]
			                                                   });
		                       },
		                       onApprove: function (data, actions) {
			                       // This function captures the funds from the transaction.
			                       return actions.order.capture().then(function (details) {
				                       // This function shows a transaction success message to your buyer.
				                       alert(tempon);
				                       alert(actions.coucou)
				                       console.log(actions)
				                       let id_user = {{\Illuminate\Support\Facades\Auth::user()->id}}
				                       $.ajax(
					                       {
						                       type: "POST",
						                       url: "/paiement-ajax",
						                       data: {
							                       details: details,
							                       id_user: id_user,

						                       },
						                       headers: {
							                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						                       },
						                       success: function (result) {
							                       alert('ok')
							                       $('#cptrose').text(result);
							                       $("#countPanier").html(0)
							                       $("#cptPanier").html(0)
							                       $("#prixPanier").html(0)
							                       $("#list").html(" ")
							                       $("#acheter").click();


						                       }
					                       }
				                       )
			                       });
		                       }
	                       }).render("article");
	            });
        // This function displays Smart Payment Buttons on your web page.
    </script>
            <script>

			    $(document).on("click", ".deletepack", function () {
				    let id = this.dataset.id
				    console.log('deb')
				    $.ajax(
					    {
						    type: "POST",
						    url: "/delete-pack",
						    data: {
							    id: id,
						    },
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    success: function (result) {
							    if (result === "good") {
								    $("#pack_" + id).remove()
							    }
						    }
					    }
				    );
			    })

			    $(document).on("click", "#deletePanier", function () {
				    let photo = this.dataset.photo
				    $.ajax(
					    {
						    type: "POST",
						    url: "/vider-panier",
						    data: {},
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    success: function (result) {
							    console.log(result)
							    $("#list").html(" ")
							    $("#countPanier").html("0")
							    $("#prixPanier").html("0")

						    }
					    }
				    );
			    });


			    $(document).on("click", ".deletePanier", function () {
				    let id_photo = this.dataset.id
				    //alert(id_photo)
				    let savethis = this
				    $.ajax(
					    {
						    type: "POST",
						    url: "/deleteOne-panier",
						    data: {
							    id_photo: id_photo
						    },
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    success: function (result) {
							    let nb   = $("#countPanier").html()
							    let prix = $("#prixPanier").html()
							    prix     = parseInt(prix) - 3;
							    nb       = parseInt(nb) - 1
							    $("#prixPanier").html(prix)
							    $("#countPanier").html(nb)
							    $("#cptPanier").html(nb)
							    console.log($($(savethis).parents()[0]).remove())


						    }
					    }
				    );
			    });

    </script>
@endsection
