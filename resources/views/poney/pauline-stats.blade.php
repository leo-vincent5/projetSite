@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/pauline-stats/delete') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger mb-3">Supprimer toutes les entrées "pauline"</button>
    </form>

    <p>Nombre total de visites : {{ $total }}</p>

    <table id="visitsTable" class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>IP</th>
            <th>Date de Visite</th>
            <th>Heure de Visite</th>
        </tr>
        </thead>
        <tbody>
        @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->ip }}</td>
                <td>{{ $visit->created_at->format('d/m/Y') }}</td>
                <td>{{ $visit->created_at->format('H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>




@endsection



