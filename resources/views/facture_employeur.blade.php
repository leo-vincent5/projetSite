@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Mes factures pour {{$employeur->nom}}</h1>
            <button id="newFactureBtn" class="mb-5 mt-3 btn btn-primary">Générer une nouvelle facture</button>
            <ul class="list-group" id="listFacture">
            @foreach($factures as $facture)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col"> {{$facture->remarque}} le {{ $facture->created_at->format('d/m/Y') }}</div>
                            <div class="col">
                                <button class="btn btn-primary editFacture" data-facture="{{$facture->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger deleteFacture" data-facture="{{$facture->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>
            @endforeach
            </ul>
        </div>
    </div>


    <button id="btnLauch" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle facture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            Sélectionner la mission
                        </div>
                        <div class="col">
                            {{\Carbon\Carbon::now()->format('d/m/y')}}
                            <select id="choixMission">
                                <option>-</option>
                                @foreach($missions as $mission)
                                    <option data-id="{{$mission->id}}">{{\Carbon\Carbon::createFromDate($mission->date)->format('d/m/y')}}  {{$mission->titre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button id="lautchMission" class="btn btn-success">new mission</button>
                            <button id="addMissionToFacture" class="btn btn-warning" data-facture="0">Ajouter</button>
                        </div>
                    </div>
                    <div class="factureDetails mt-4">

                        <div style="text-align: center"> <h4> Details de la facture :</h4></div>


                        <div class="row mt-4">
                            <div class="col-2">
                                Information  :
                            </div>
                            <div class="col-8">
                                <textarea id="informationFacture" style="width: 100%" name="nomFacture"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="my-3" style="text-align: center"><h4>Vos différentes missions : </h4></div>

                    <div id="missionConteneur">

                    </div>

                    <div class="row">
                        <div class="col-10">

                        </div>
                        <div class="col-2">
                             Total : <span id="totalFacture"></span>
                        </div>

                    </div>

                    <div id="missionNew">
                        <div class="row mt-5">
                            <div class="col">
                                Titre de la mission
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input id="titreMission" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                Date
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input id="dateMission" class="form-control" type="date">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                Lieu
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input id="lieuMission" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                Prix
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input id="prixMission" class="form-control" type="number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button id="addMission" class="btn btn-primary">Ajouter</button>
                                    <button id="backMission" class="btn btn-danger">Retour</button>
                                </div>
                            </div>
                        </div>
                        <div class="factureContent"></div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="saveFacture" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a id="lienFacture" href="{{route("generate_pdf",['id' => 0])}}"><button type="button" class="btn btn-primary">Générer le pdf</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">

        </div>
    </div>




    </div>

@endsection


@section('js')
    <script>
        $(document).ready(function () {
            let cpt = 0;
            $("#missionNew").hide();




            $(document).on("click",".deleteFacture",function (){
            	let facture = this.dataset.facture;
            	let savethis = this;
            	if (confirm("Etes vous de vouloir supprimer cette facture ? ")){
                    $.ajax(
                    {
                        type: "POST",
                        url: "/delete_facture",
                        data: {
                            facture_id: facture,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log($(savethis).parents()[2].remove())
                        }
                    }
                );
                }

            })


            $(document).on('click','.editFacture',function (){
            	let facture = this.dataset.facture
                $('#addMissionToFacture').attr('data-facture',facture)
                   $("#btnLauch").click();
            	$("#lienFacture")[0].href   = "/generate_pdf/"+facture
            	getLigneFacture(facture)

            });


            function getLigneFacture(id){
            	$.ajax(
                    {
                        type: "POST",
                        url: "/get_all_ligne",
                        data: {
                            facture_id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                            let total = 0;
                            let retour = ""
                            for (let i = 0 ; i < result.length ; i++ ){
                            	total+= parseInt(result[i].prix)
                                console.log(result[i])
                                retour += "<div class='row my-2'><div class='col'> Titre : "+result[i].titre+"</div><div class='col'>Lieu :"+result[i].lieu+"</div><div class='col'>Prix :"+result[i].prix+"€</div> <div class='col'><button data-deleteId='"+result[i].id+"' class='btn btn-danger deletedLiaison'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/></svg></button></div> </div><hr> "
                            }
                            console.log(retour)
                            $("#totalFacture").html(total+" €")
                            $("#missionConteneur").html(retour)
                        }
                    }
                );
            }

            $(document).on('click', '#saveFacture', function () {
                let facture_id = $("#addMissionToFacture")[0].dataset.facture
                let remarque = $("#informationFacture").val()
                $.ajax(
                    {
                        type: "POST",
                        url: "/add_remarque_facture",
                        data: {
                            facture_id: facture_id,
                            remarque: remarque,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                        }
                    }
                );
            })


            $(document).on('click', '#newFactureBtn', function () {

                $("#btnLauch").click();
                $("#addMissionToFacture").attr('data-facture',0)

                $("#missionConteneur").html(" ")
                $("#totalFacture").html(" 0 €")

            });


            $(document).on("focusout",'#informationFacture',function (){
            	let remarque = $(this).val()
                let facture = $("#addMissionToFacture")[0].dataset.facture
                $.ajax(
                    {
                        type: "POST",
                        url: "/edit_remarque_facture",
                        data: {
                            facture_id: facture,
                            remarque : remarque
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                        }
                })

            });

            $(document).on('click', '#lautchMission', function () {
                cpt++;
                if (cpt === 2) {
                    cpt = 0
                    $("#missionNew").hide(1000);
                } else {
                    $("#missionNew").show(1000);
                }

            });

            $(document).on('click', '#backMission', function () {
                $("#missionNew").hide(1000);
                cpt = 0
            });


             $(document).on('click', '.deletedLiaison', function () {
             	let savethis = this
                let liaison = this.dataset.deleteid
                let facture = $("#addMissionToFacture").data('facture')
                 console.log($(this).parents());
                 $.ajax(
                    {
                        type: "POST",
                        url: "/delete_liaison_facture",
                        data: {
                            facture_id: facture,
                            activite_id: liaison,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                            if (result.status === "supprimer"){
                            	console.log($($(savethis).parents()[1]).hide(250))
                                let tab = $("#totalFacture").html().split(' €')
                                console.log(tab)
                                let somme = parseInt(tab[0]) - parseInt(result.prix)
                                console.log(somme)
                                $("#totalFacture").html(somme+" €")

                            }


                        }
                    }
                );

            });



            $(document).on('click', '#addMission', function () {
                let titre = $("#titreMission").val();
                let dateMission = $("#dateMission").val();
                let lieuMission = $("#lieuMission").val();
                let prixMission = $("#prixMission").val();

                $.ajax(
                    {
                        type: "POST",
                        url: "/admin_add_mission",
                        data: {
                            titre: titre,
                            date: dateMission,
                            lieu: lieuMission,
                            prix: prixMission,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                            $("#choixMission").append("<option data-id='"+result.id+"'>"+result.date+" "+result.titre+"</option>")

                        }
                    }
                );
            })


            $(document).on('click', '#addMissionToFacture', function () {
                let saveThis = this
                let facture_id = this.dataset.facture
                let elementSelected = $($("#choixMission")[0])[0].selectedIndex;
                let activite_id = $($("#choixMission")[0])[0].options[elementSelected].dataset.id
                $.ajax(
                    {
                        type: "POST",
                        url: "/add_facture_progress",
                        data: {
                            activite_id : activite_id,
                            facture_id : facture_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            console.log(result)
                            $(saveThis).attr('data-facture',result.facture.id)
                            let retour = "";
                            let total = 0;
                            for (let i = 0 ; i < result.activites.length ; i++ ){
                            	total+= parseInt(result.activites[i].prix)
                                console.log(result.activites[i])
                                retour += "<div class='row my-2'><div class='col'> Titre : "+result.activites[i].titre+"</div><div class='col'>Lieu :"+result.activites[i].lieu+"</div><div class='col'>Prix :"+result.activites[i].prix+"€</div> <div class='col'><button data-deleteId='"+result.activites[i].id+"' class='btn btn-danger deletedLiaison'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/></svg></button></div> </div><hr> "
                            }

                            $("#totalFacture").html(total+" €")

                             $("#missionConteneur").html(retour)

                             $("#lienFacture")[0].href   = "/generate_pdf/"+result.facture.id


                            console.log("facture id = "+facture_id)
                             if (facture_id == "0"){
                                console.log("passse ici ")

      let resultHtml = "                      <li class='list-group-item'>"
      +"                  <div class='row'>"
      +"                      <div class='col'> "+result.facture.remarque+" le"+result.facture.created_at+"</div> "
      +"                      <div class='col'> "
      +"                          <button class='btn btn-primary editFacture' data-facture='"+result.facture.id+"'>"
      +"                              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>"
      +"                                  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>"
      +"                                  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>"
      +"                              </svg>"
      +"                          </button>"
      +"                      </div>"
      +"                      <div class='col'>"
      +"                          <button class='btn btn-danger deleteFacture' data-facture='"+result.facture.id+"'>"
      +"                              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>"
      +"                                  <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>"
      +"                              </svg>"
      +"                          </button>"
      +"                      </div>"
      +"                  </div>"
      +"              </li>"

                            $("#listFacture").append(resultHtml)
                                 }


                        }
                    }
                );

            });



        })
    </script>
@endsection
