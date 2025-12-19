@extends("layouts.app")


@section("content")
 @php
                $par =  explode("/",$file);
                $paar2 = explode("-",$par[4]);
                $link = $par[0]."/".$par[1]."/".$par[2]."/".$par[3]."/encode-".$paar2[1];
                $link2 = $par[0]."/".$par[1]."/".$par[2]."/".$par[3]."/".$paar2[1];
                @endphp
     <div style="text-align: center">


            @php $essais = \App\Panier::query()->where('id_photo','=',$photo->id)->where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)->get(); @endphp
            @if(count($essais) == 1)
                <button id="reservePhoto" class="btn btn-warning" data-photo="{{$link2}}">Retirer du panier</button>
            @else
                <button id="reservePhoto" class="btn btn-success" data-photo="{{$link2}}">Ajouter au panier</button>
            @endif
         <a href="./"><button id="retour" class="btn btn-danger">Retour à la galerie</button></a>
         <button id="tournerplus" class="btn btn-primary">Tourner la photo</button>
        </div>

<div style="text-align: center;">



                <img id="photounique" data-rotate="0" src="/{{$link}}" style="    padding: 0px;
    /* max-width: 600px; */
    padding: 0px;
    max-width: 80vw;
    max-height: 80vh;
    margin-top: 2vh;
    margin-bottom: 10vh;
   ">

     <div style="text-align: center"><a style="font-size:large" href="#info"> + d'info</a></div>
            </div>
    <div class="container">
        @if (session('status'))
    <div class="alert alert-success" style="font-size: 20px;">
        {{ session('status') }}
    </div>

@endif

        @csrf
        <div class="row">
            <div class="col">

                <br>
                <br>
                <h1>
                    <ul style="    font-size: 4vh;">
                        <li id="info" class="mb-5">Prix unitaire 3€ version numérique, 10€ version tirage au format 10:15 (frais de port inclus)</li>

                        <li>Pack photos d'un concours (dossier d'une même personne) en numérique <br>25€ </li>
                    </ul></h1>
                <br>
                <hr>
                <br>
                <h1 style="text-align: center;" >Commander votre photo en tirage :</h1>

                <form method="post" action="{{route("envoi")}}">
                    @csrf
                    <div class="input-group mb-3 mt-5 ">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1" style="font-size: 20px;">@Adresse email</span>
                      </div>
                      <input style="font-size: 20px;" type="email" class="form-control" name="email" placeholder="Taper votre addresse mail" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                      <div class="form-check">
                        <input name="unite[]" value="photounite" style="width: 100px;height: 25px;font-size: 20px;" type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label style="margin-left: 80px;font-size: 20px" class="form-check-label" for="exampleCheck1">Photo à l'unité</label>
                      </div>

                    <div class="form-check mt-3">
                        <input name="unite[]" value="pack" style="width: 100px;height: 25px;font-size: 20px;" type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label  style=" margin-left: 80px;font-size: 20px" class=" form-check-label" for="exampleCheck1">Pack numérique de cette personne</label>
                      </div>

                     <div class="form-group mt-3">
                    <label for="exampleFormControlTextarea1" style="font-size: 20px">Votre message</label>
                    <textarea name="text" style="font-size: 20px;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
                    <input class="d-none" name="photo" value="{{$file}}">
                  <button style="font-size: 20px;" type="submit" class="btn btn-primary">Envoyer</button>
                </form>


            </div>

        </div>


    </div>
@endsection


@section("js")
    <script>

        $(document).on("click", "#reservePhoto", function() {
            let photo = this.dataset.photo
            $.ajax(
              {
                  type : "POST",
                      url : "/add-panier",
                  data : {
                      photo_name : photo
                  },
                  headers : {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success : function (result)
                  {
                      if(result === "success") {
                          $("#reservePhoto").html('Retirer du panier')
                          $("#reservePhoto").removeClass('btn-success')
                          $("#reservePhoto").addClass('btn-warning')
                          let cpt = $("#cptPanier").html()
                          cpt = parseInt(cpt) + 1;
                          $("#cptPanier").html(cpt)
                      } else {
                          $("#reservePhoto").html('Ajouter du panier')
                          $("#reservePhoto").removeClass('btn-warning')
                          $("#reservePhoto").addClass('btn-success')
                          let cpt = $("#cptPanier").html()
                          cpt = parseInt(cpt) - 1;
                          $("#cptPanier").html(cpt)
                      }

                      console.log('essais')
                  }
              }
          );
        });

        $(document).on("click", "#tournerplus", function() {
            console.log($("#photounique"))
            let rotate = $("#photounique")[0].dataset.rotate
            $("#photounique").attr("data-rotate",  +rotate+ 90 );
            $("#photounique").css("transform","rotate("+parseFloat(+rotate +90)+"deg)")
        });
    </script>
    @endsection
