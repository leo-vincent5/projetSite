@extends('layouts.app')


@section('content')
    <div class="container">
        <div style="
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
"><h1>Votre pack photo : </h1><a href="{{route('history')}}" class="btn btn-danger">Retour</a></div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Pensez à sauvegarder vos photos sur votre ordinateur ou votre téléphone. Equicode stocke vos achats pour un minimum de 6 mois

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>

        <div>
            @foreach($photos as $photo)
            @php $result =  explode("/",$photo->name) @endphp
                @php $newResult = "" @endphp
                @php $cpt = 0 @endphp
                @foreach($result as $item)
                    @php $cpt++ @endphp
                     @if($cpt == count($result))
{{--                        @dump($item)--}}
                         @php $newResult.=  "traiter-"; @endphp
                    @else
                        @php $newResult = $newResult.$item."/" ;@endphp
                    @endif
                @endforeach


            <img src="/{{$newResult.$photo->encode.".jpg"}}" style="width: 20vw">
        @endforeach
            </div>

    </div>
@endsection
