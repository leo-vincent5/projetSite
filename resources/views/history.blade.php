@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5" style="text-align: center"><h1>Vos packs photo acheté</h1></div>

        <ul class="list-group">
            @foreach($packs as $pack)
                <a href="{{route('showPack',['id' => $pack->id])}}"><li class="list-group-item" style=" display: flex;
    align-items: center;
    justify-content: space-between;"><img src="/{{$pack->preview}}" style="height: 30vh;"> <h1>Acheté le {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pack->created_at)->format('d/m/Y')}}</h1> </li></a>
            @endforeach
        </ul>

        <div style="text-align: center"><h1 class="my-5">Vos photos que vous avez achetées à l'unité ({{count($achats)}}) </h1></div>
        @foreach($achats as $achat)
            <div>
{{--                @dd($achat->photo()->first())--}}
                @php $result =  explode("/",$achat->photo()->first()->name) @endphp
                @php $newResult = "" @endphp
                @php $cpt = 0 @endphp
                @foreach($result as $item)
                    @php $cpt++ @endphp
                     @if($cpt == count($result))
{{--                        @dump($item)--}}
                    @else
                        @php $newResult = $newResult.$item."/" ;@endphp
                    @endif
                @endforeach
                @php($url = $newResult."traiter-".$achat->photo()->first()->encode.".jpg")
                <img src="{{$url}}" style="height: 60vh;">
            </div>
        @endforeach
    </div>
@endsection
