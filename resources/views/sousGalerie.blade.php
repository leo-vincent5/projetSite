@extends("layouts.app")

@section("content")

    <div class="container"><a href="./"> <button class="btn btn-danger">Retour aux choix</button></a> <div class="row">
        @php



        @endphp

    @foreach($files as $file)
        @if($file == "." or $file == ".." or $file == "preview.jpg" or $file == "vignette-preview.jpg")

        @else


                <div class="col-sm-4 mt-5" style="text-align: center">

                            <a href="{{route("club-view",['name' => $name, 'club' => $file])}}">
                            <img style="max-width: 100%;" src="/img/galerie/{{$name}}/{{$file}}/vignette-preview.jpg">
                            <h3>{{$file}}</h3>
                            </a>
                    </div>

        @endif


        <br>
    @endforeach   </div>
    </div>
@endsection
