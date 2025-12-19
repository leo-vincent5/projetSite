@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
        @foreach($files as $file)
            @if($file == "." or $file == "..")

            @else

                    <div class="col-sm-4 mt-5" style="text-align: center">
                        <div>
                            <a href="{{route("under-galerie",['name' => $file])}}">
                            <img style="max-width: 100%;" src="img/galerie/{{$file}}/preview.jpg">
                            <h3>{{$file}}</h3>
                            </a>
                        </div>
                    </div>

            @endif
        @endforeach
    </div>

{{--     <div class="waiter">--}}
{{--            <div style="text-align: center;">--}}
{{--                <img src="/img/cabre.gif"> <h4>Vous pouvez suivre ici la progression du traitement des photos pour <b>La fete du club du centre équestre salonnais.</b></h4>--}}
{{--            </div>--}}
{{--                <div class="progress">--}}
{{--                <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>--}}
{{--            </div>--}}
{{--            <button id="btnmoreinfo" class="btn btn-success"> + Plus d'information</button>--}}
{{--            <div id="moreinfo" class="" >--}}
{{--                <div>--}}
{{--                    Nombre de photo à traiter : <b>0</b>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    Temps de travail actuel  : <b>68 h</b>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    Estimation de la disponibilité de vos photos : <b>Disponible Samedi 25/07 </b>--}}
{{--                </div>--}}
{{--                <a target="_blank" class="btn btn-primary" href="https://calendar.google.com/calendar/u/0/r/eventedit?text=Photo+equicode&dates=20210703/20210704&ctz=Europe/Salon-de-Provence&details=photo+de+la+fete+du+club+sur+%3Ca+href=%27www.equicode.fr%27%3Eequicode.fr%3C/a%3E&location=Salon-de-Provence,+france&pli=1">Mettre un rappel dans mon calendrier</a>--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>
@endsection



@section('js')
    <script>
         $("#moreinfo").hide()
        $(document).on("click","#btnmoreinfo", function () {
            $("#moreinfo").show(1000)
        })
    </script>
@endsection
