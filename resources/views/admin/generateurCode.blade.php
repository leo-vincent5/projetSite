@extends('layouts.app')


@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container">


        <h2>Generateur de code promo </h2>
        <form method="post" action="{{route('createCode')}}">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" id="code" aria-describedby="emailHelp" value=""
                       placeholder="Poney13">

            </div>

            <button class="btn btn-success" onclick="essais(); return false;">Generer random</button>


            <div class="form-group">
                <label for="exampleInputEmail1">Nombre d'utilisation</label>
                <input type="number" class="form-control" name="nbUtilisation" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       value="1">

            </div>


            <div class="form-group">
                <label for="exampleDateDelais">Nb de jours de durée</label>
                <input type="number" class="form-control" name="nbduree" id="exampleDateDelais"
                       aria-describedby="emailHelp"
                       value="">

            </div>

            <div class="form-group">
                <label for="examplephoto">Nb de photos offerts</label>
                <input type="number" class="form-control" name="nbphoto" id="examplephoto"
                       aria-describedby="emailHelp"
                       value="">

            </div>

            <div class="form-group">
                <label for="details">Details du code </label>
                <input type="text" class="form-control" name="details" id="details" aria-describedby="emailHelp"
                       value="">

            </div>


            <button type="submit" class="btn btn-primary">Créer le code</button>
        </form>
    </div>
    <div class="container">
        <h2>Les codes deja existant : </h2>

        <ul class="list-group">
            @foreach($codes as $code)
                <li class="list-group-item" id="code_{{$code->id}}">
                    <button data-id="{{$code->id}}" data-code="{{$code->code}}" data-details="{{$code->details}}"
                            class="btn btn-danger deleteCode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path
                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                    <button class="btn btn-success">Copier</button>
                    <span style="font-size: 30px">{{$code->code}}</span> crée le
                    : {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $code->created_at)->format('d/m/yy')}}
                    expire le :
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $code->created_at)->addDays($code->nb_jours)->format('d/m/yy')}}
                    (durée {{$code->nb_jours}} jours)
                    Details : {{$code->details}}

                </li>
            @endforeach
        </ul>

    </div>


    <!-- Button trigger modal -->
    <button id="btnactive" type="button" class="btn btn-primary d-none" data-toggle="modal"
            data-target="#exampleModalCenter">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Voulez-vous vraiment supprimer le code promo</h5>
                    <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="align-content-center" style="text-align: center"><h2><span id="codeSupp"></span></h2>
                        Details : <span id="detailsSupp"></span></div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="annule" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" id="suppConfirm" class="btn btn-danger"  data-dismiss="modal">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function () {
            $(".deleteCode").on('click', function () {
                $("#btnactive").click()
                let id = ($(this)[0].dataset.id)
                $("#codeSupp").html($(this)[0].dataset.code)
                $("#detailsSupp").html($(this)[0].dataset.details)
                $("#suppConfirm").removeAttr('data-id')
                $("#suppConfirm").attr('data-id',id)
            });

            $('#suppConfirm').on('click', function (){
                let id_code = this.dataset.id
                $.ajax(
                    {
                        type: "POST",
                        url: "/delete_code_promo",
                        data: {
                            id_code: parseInt(id_code),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                          if (result === 'success'){
                              $("#code_"+id_code).remove();
                              $("#close").click();
                          }
                        }
                    }
                );
            })

        });

        function essais() {
            event.stopPropagation()
            $("#code")[0].value = generateRandomString(6)
        }

        const generateRandomString = (num) => {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result1 = ' ';
            const charactersLength = characters.length;
            for (let i = 0; i < num; i++) {
                result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            return result1;
        }

        const displayRandomString = () => {
            let randomStringContainer = document.getElementById('random_string');
            randomStringContainer.innerHTML = generateRandomString(8);
        }


    </script>
@endsection
