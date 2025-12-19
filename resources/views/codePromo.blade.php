@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            {!!  session()->get('success') !!}
        </div>
    @endif

        <div id="success" class="alert alert-success alert-dismissible">

        </div>

        <div id="error" class="alert alert-danger alert-dismissible">

        </div>

        @if(session()->has('errors'))
        <div class="alert alert-danger alert-dismissible">
            {{ session()->get('errors') }}
        </div>
    @endif

            <h3 class="mt-3">Utiliser votre code promo </h3>
            <ul class="mt-3 list-group">
                <li class="list-group-item"> <span class="etiquette" style="margin-right: 3vw;">1</span> Ajoutez une image <a href="{{route('gallery')}}">de la galerie </a> dans votre panier</li>
                <li class="list-group-item"><span class="etiquette" style="margin-right: 3vw;">2</span>  Inserez votre code pour pouvoir avoir des crédits pour débloquer des photos</li>
                <li class="list-group-item"><span class="etiquette" style="margin-right: 3vw;">3</span>  Dévérouillez gratuitement ci-dessous vos plus belles photos</li>
            </ul>


         <div class="mt-5 form-group">
            <h3><label for="exampleInputEmail1">Entrez votre code promo</label></h3>
            <input type="text" class="form-control" id="codePromo" aria-describedby="emailHelp" placeholder="exemple : SPIRIT5">
            <small id="emailHelp" class="form-text text-muted">Attention, vous avez un nombre limité d'essaies afin d'éviter toutes tentatives de fraude.</small>
        </div>
        <button id="valider" class="btn btn-primary">Valider</button>


        <div class="my-3">
            @if ($nbPhoto == null)
                <h3>Vous n'avez pas de photo à débloquer grâce à vos codes promos</h3>
                @else
                <h3>Vous avez actuellement <span id="cptPhoto">{{$nbPhoto->nb_photo}}</span> crédit(s) pour débloquer vos photos</h3>
            @endif
        </div>

        <div>
            @foreach($paniers as $panier)
                <div>
                    <hr>
                    <div style="display: flex;flex-flow: row wrap;justify-content: space-evenly;align-items: center;">
                    <img style="width: auto; max-height: 300px; max-width: 80vw;" src="/{{$panier->photo()->first()->name_notbuy}}"> <a href="{{route('useCodePromo',['id' => $panier->photo()->first()->id])}}"><button data-id="{{$panier->photo()->first()->id}}" class="btn btn-success">Débloquer ma photo pour 1 crédit</button></a>
                    </div>
                </div>
        @endforeach
        </div>


    </div>



@endsection


@section('js')
    <script>

        $( document ).ready(function() {
    $("#error").hide();
    $("#success").hide();

    $( "#codePromo" ).keydown(function(e) {
    if(e.code === 'Enter'){
        $("#valider").click()
    }
});


});


        $(document).on('click','#valider',function () {
            let codePromo = $("#codePromo").val()



            $.ajax(
                    {
                        type: "POST",
                        url: "/sendCodePromo",
                        data: {
                            codePromo: codePromo,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                           if(result['success'] === undefined){
                               $("#error").html(result['errors']);
                               $("#error").show();
                               console.log('passe erreur ');
                           } else {
                                $("#success").html(result['success']);
                                $("#cptPhoto").html(result['nb'])
                                $("#success").show();
                               console.log('passe success ');
                           }
                        }
                    }
                );


        })
    </script>
@endsection
