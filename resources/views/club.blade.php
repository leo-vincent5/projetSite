@extends("layouts.app")

@section("js")
    <script>
         $( document ).ready(function() {
             let drapeau = 0;
             $(document).on("click", "#addSpeedActive", function () {
                let essais = $(".speedAdd")
                console.log(drapeau)
                    for (const [key, value] of Object.entries(essais)) {
                        if (drapeau === 0 ){

                            console.log($($(".speedAdd")[key]).removeClass('d-none'));
                        } else {
                            console.log($($(".speedAdd")[key]).addClass('d-none'));

                        }


                    }
                    if (drapeau === 0 )
                    {
                        drapeau = 1
                    } else{
                          drapeau = 0;
                    }

             })

             $(document).on("click",'#packBuy', function () {
                let tableau = $(".addSpeed");
                let tab = []
                 let cpt = 0;
                for (let [cle, valeur] of Object.entries(tableau)){
                    cpt++
                    if (cpt > tableau.length){
                        continue
                    }
                  console.log(valeur.dataset.id);
                  tab.push(valeur.dataset.id);
                  console.log(tableau.length)
                }
                console.log(tab)
                let cle = window.location.pathname
                 $.ajax(
              {
                  type : "POST",
                      url : "/add_pack",
                  data : {
                      cle : cle,
                      tab : tab
                  },
                  headers : {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success : function (result)
                  {
                      if (result === "good"){
                        window.location.href = "/panier"
                      } else {

                      }
                     // console.log(result)
                  }
              }
          );

             })

             $(document).on("click", ".addSpeed", function () {
                let photo = this.dataset.id
                 let thissave = this
                 $.ajax(
              {
                  type : "POST",
                      url : "/add_panier_speed",
                  data : {
                      photo_name : photo
                  },
                  headers : {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success : function (result)
                  {
                      if (result === "good"){
                          console.log("ok")
                          $('#cptPanier').html(parseInt($("#cptPanier").html())+1)
                          $(thissave).removeClass('btn-success')
                          $(thissave).addClass('btn-warning')
                          $(thissave).html("Retirer du panier")
                      } else {
                          $('#cptPanier').html(parseInt($("#cptPanier").html())-1)
                           $(thissave).removeClass('btn-warning')
                          $(thissave).addClass('btn-success')
                          $(thissave).html("Ajouter du panier")
                      }
                      console.log(result)
                  }
              }
          );
             })
         })






    </script>
@endsection


@section("css")
    <style>
        @import url(https://fonts.googleapis.com/css?family=Quicksand:400,300);
body{
    font-family: 'Quicksand', sans-serif;
}
.gal-container{
	padding: 12px;
}
.gal-item{
	overflow: hidden;
	padding: 3px;
}
.gal-item .box{
	height: 350px;
	overflow: hidden;
}
.box img{
	height: 100%;
	width: 100%;
	object-fit:cover;
	-o-object-fit:cover;
}
.gal-item a:focus{
	outline: none;
}
.gal-item a:after{
	content:"\e003";
	font-family: 'Glyphicons Halflings';
	opacity: 0;
	background-color: rgba(0, 0, 0, 0.75);
	position: absolute;
	right: 3px;
	left: 3px;
	top: 3px;
	bottom: 3px;
	text-align: center;
    line-height: 350px;
    font-size: 30px;
    color: #fff;
    -webkit-transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    transition: all 0.5s ease-in-out 0s;
}
.gal-item a:hover:after{
	opacity: 1;
}
.modal-open .gal-container .modal{
	background-color: rgba(0,0,0,0.4);
}
.modal-open .gal-item .modal-body{
	padding: 0px;
}
.modal-open .gal-item button.close{
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: #000;
    opacity: 1;
    color: #fff;
    z-index: 999;
    right: -12px;
    top: -12px;
    border-radius: 50%;
    font-size: 15px;
    border: 2px solid #fff;
    line-height: 25px;
    -webkit-box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
	box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
}
.modal-open .gal-item button.close:focus{
	outline: none;
}
.modal-open .gal-item button.close span{
	position: relative;
	top: -3px;
	font-weight: lighter;
	text-shadow:none;
}
.gal-container .modal-dialogue{
	width: 80%;
}
.gal-container .description{
	position: relative;
	height: 40px;
	top: -40px;
	padding: 10px 25px;
	background-color: rgba(0,0,0,0.5);
	color: #fff;
	text-align: left;
}
.gal-container .description h4{
	margin:0px;
	font-size: 15px;
	font-weight: 300;
	line-height: 20px;
}
.gal-container .modal.fade .modal-dialog {
    -webkit-transform: scale(0.1);
    -moz-transform: scale(0.1);
    -ms-transform: scale(0.1);
    transform: scale(0.1);
    top: 100px;
    opacity: 0;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
}

.gal-container .modal.fade.in .modal-dialog {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    -webkit-transform: translate3d(0, -100px, 0);
    transform: translate3d(0, -100px, 0);
    opacity: 1;
}
@media (min-width: 768px) {
.gal-container .modal-dialog {
    width: 55%;
    margin: 50 auto;
}
}
@media (max-width: 768px) {
    .gal-container .modal-content{
        height:250px;
    }
}
/* Footer Style */
i.red{
    color:#BC0213;
}
.gal-container{
    padding-top :75px;
    padding-bottom:75px;
}
footer{
    font-family: 'Quicksand', sans-serif;
}
footer a,footer a:hover{
    color: #88C425;
}
main{
    text-align: center;
    text-align: -webkit-center;
}
    </style>
@endsection
@section("content")
    @csrf
    <a href="./"> <button class="btn btn-danger">Retour aux choix</button></a>
     <button id="packBuy" class="btn btn-success">Acheter le pack</button>
    <button id="addSpeedActive"  class="btn btn-primary">Activer l'ajout rapide</button>
  <div class="container gal-container row">

      @foreach($files as $file)

          @if( preg_match("/vignette/i",$file) > 0 && strpos($file,'preview') != true)
              @php $val = explode("vignette-","img/galerie/".str_replace(" "," ",$name)."/".str_replace(" "," ",$club)."/".$file) @endphp

               <a class="speedAdd d-none"> <button class=" mt-3 btn btn-success addSpeed" data-id="{{$val[0].$val[1]}}">Ajouter au panier</button></a>
          <div class="col-md-4 col-sm-6 co-xs-12 gal-item reserve">
      <div class="box">

          <a href="{{route("reserve",["name" => $name,"club" => $club,"file" => $file])}}"></a><img src="/img/galerie/{{str_replace(" "," ",$name)}}/{{str_replace(" "," ",$club)}}/{{$file}}" data-id="{{$name}}-{{$club}}-{{$file}}">

      </div>

    </div>

          @endif
      @endforeach
  </div>

@endsection


