@extends('layouts.app')


@section('content')

    <h2>Liste des paniers des utilisateurs : (<span id="cptPanierUser"></span>) </h2>

    <ul id="listPanier">
        <img alt="chargement" style="width: 10vw" src="tenor.gif">

    </ul>

@endsection

@section('js')
    <script>
        $(document).ready(function () {

            function coucou(){
            	$.ajax(
                    {
                        type: "POST",
                        url: "/get_panier_user",

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                        	$("#cptPanierUser").html(result.length)
                            console.log($("#cptPanierUser"))
                            console.log(result.length)
                            let htmlPanier = "";
                            for (let i = 0; i < result.length ; i++){
                            	console.log(result[i].id)
                                htmlPanier+= "<li>Utilisateur : "+result[i].user.email+"</li>"
                            }

                            $("#listPanier").html(htmlPanier)
                        }
                    }
                );
            }

            setInterval(coucou,2000)
        });
    </script>
@endsection
