@extends('layouts.app')

@section('content')
    <div style="text-align: center">
            <a  href="{{route("filtre")}}" class="btn btn-danger" style="color: white;">Appliquer le watermark à tout le site</a>
            <a href="{{route("generateurCode")}}" class="btn btn-primary">Générer des codes promos</a>
            <a href="{{route("gestion")}}" class="btn btn-success">Comptabilité</a>
        </a></div>

    <div class="my-5 container">
        <h1 class="m-5">Nouvel article ajouter aux panier :</h1>
        <div class="row">
            <div class="col">
                Photo :
            </div>
            <div class="col">
                Email
            </div>
            <div class="col">
                Mis dans le panier
            </div>
            <div class="col">
                Photo
            </div>
            <div class="col">
                date de reservation
            </div>
        </div>
        <hr>
        <div class="globalRes">
           
            @foreach($paniers as $panier)

                <div class="row">
                    <div class="col">
                        <img src="/{{ $panier->photo()->first()->name_notbuy}}" style="width: 5vw;">
                    </div>
                    <div class="col">
                       
                    </div>
                    <div class="col">
                        {{$panier->created_at}}
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>
                </div>
                <hr>
            @endforeach
        </div>

        <h1 class="m-5">Les photos achatées : </h1>

        <div>
            <div class="row">
                <div class="col">
                    Photo :
                </div>
                <div class="col">
                    Email
                </div>
                <div class="col">
                    Mis dans le panier
                </div>
                <div class="col">
                    Prix €
                </div>
                <div class="col">
                    type
                </div>
            </div>
            <hr>
            <div class="resultPaiement">
                @foreach($paiements as $paiement)
                    <div class="row">
                        <div class="col">
                            <img src="/{{$paiement->photo()->first()->name_notbuy}}" style="width: 5vw;">
                        </div>
                        <div class="col">
                            {{$paiement->user()->first()->email}}
                        </div>
                        <div class="col">
                            {{$paiement->user()->first()->created_at}}
                        </div>
                        <div class="col">
                            3 €
                        </div>
                        <div class="col">
                            unique
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            function go() {
                $.ajax(
                    {
                        type: "POST",
                        url: "/get-paiement-ajax",
                        data: {
                            details: details,
                            id_user: id_user,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            //
                            // $('#cptrose').text(result);
                            // $("#countPanier").html(0)
                            // $("#cptPanier").html(0)
                            // $("#prixPanier").html(0)
                            // $("#list").html(" ")
                            // $("#acheter").click();
                        }
                    }
                );
            }
        });

    </script>
@endsection
