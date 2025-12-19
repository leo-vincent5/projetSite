@extends('layouts.app')


@section('content')
    <div class="container">
        <div style="text-align: center"><h1>Panel de Gestion</h1></div>
        <div><h2>Prestation de service</h2></div>


        <button id="addEmployeur" class="btn btn-success">Ajouter un employeur</button>
        <div id="hiddenEmployeur" class="">
            <div class="row my-3">
                <div class="col-1">Nom :</div>
                <div class="col-1"><input id="nomEmployeur" type="text"></div>
            </div>
            <div class="row">
                <div class="col-1">Email :</div>
                <div class="col-1"><input id="emailEmployeur" type="email"></div>
            </div>
            <div class="row my-3">
                <div class="col-1">Siret :</div>
                <div class="col-1"><input id="siretEmployeur" type="text"></div>
            </div>
            <div class="row my-3">
                <div class="col-1"></div>
                <div class="col-1" style="display: inline-flex">
                    <button id="addEmployeurButton" class="btn btn-primary mr-3">Ajouter</button>
                    <button id="hideEmployer" class="btn btn-danger">Annuler</button>
                </div>
            </div>
        </div>

        <div id="employeurList" class="my-3 list-group" style="    width: 100%;
    display: flex;
    justify-content: space-evenly;
    flex-direction: column;
    align-content: center;
    flex-wrap: nowrap;
    align-items: stretch;">
            @foreach($employeurs as $employeur)
                <li class="list-group-item" style="width: 100%">
                    <div><h5>{{$employeur->nom}}</h5>
                        <div style="width: 100%;
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;">
                            <button class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                            </button>
                            <button class="btn btn-danger" onclick="suppEmployeur(this);" data-id="{{$employeur->id}}" data-nom="{{$employeur->nom}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                            <a href="{{route("admin_facture",['id' => $employeur->id])}}"><button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </button></a>
                        </div>
                    </div>
                </li>
            @endforeach
        </div>


        <div class="my-5"><h2>Mes factures ()</h2></div>


    </div>
@endsection

@section('js')
    <script>

        	function suppEmployeur(button) {
				var r = confirm("Etes vous sure de vouloir supprimer l'employeur "+ button.dataset.nom+" ?");
				if (r == true) {
                    let id = button.dataset.id
                    $.ajax(
					{
						type: "POST",
						url: "/admin_delete_employeur",
						data: {
							id: id
						},
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						success: function (result) {
							console.log(result)
                            $($(button).parents()[2]).remove();

						}
					}
				)}
			}

		$(document).ready(function () {


			$("#hiddenEmployeur").hide()
			$(document).on('click', '#addEmployeur', function () {
				$("#hiddenEmployeur").show(1000)
			});

			$(document).on('click', '#hideEmployer', function () {
				$("#hiddenEmployeur").hide(1000)
			});

			$(document).on('click', '#addEmployeurButton', function () {
				let siret = $("#siretEmployeur").val()
				let email = $("#emailEmployeur").val()
				let nom   = $("#nomEmployeur").val()

				$.ajax(
					{
						type: "POST",
						url: "/admin_add_employeur",
						data: {
							siret: siret,
							email: email,
							nom: nom
						},
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						success: function (result) {
							console.log(result)
                            $("#employeurList").append(`<li class="list-group-item" style="width: 100%">
    <div><h5>`+result.nom+`</h5>
        <div style="width: 100%;display: flex;flex-wrap: nowrap;justify-content: space-around;align-items: center;">
            <button class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                </svg>
            </button>
            <button class="btn btn-danger" onclick="suppEmployeur(this);" data-id="`+result.id+`" data-nom="`+result.nom+`">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
            </button>
        </div>
    </div>
</li>`);

						}
					}
				)
			});
		})
		;
    </script>
@endsection

