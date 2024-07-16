@extends('layouts.app')

@section('content')
<div class="container">

    <div class="text-center">
        <h1>Vista de votante</h1>
        <h5>Para ser un admin cierra sesión</h5>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Votaciones disponibles') }}</div>

                @foreach($votaciones as $votacion)
                @if($votosPersonales->contains('votacion_id', $votacion->id))
                    <!-- Si el usuario ya votó en la votación, no mostrar -->
                @else
                <div class="card-body m-2 p-2 bg-primary text-white text-center">
                    
                    <h1>{{ $votacion->titulo }}</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Votación</th>
                                <th>Candidato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votacion->candidatos as $candidato)
                                <tr>
                                    <td>
                                    <form action="{{route('votos.create')}}" method="post" class="d-flex align-items-center mb-4">
                                    @csrf
                                        <button type="submit" class="btn btn-success mr-4">Votar</button>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="votacion_id" value="{{$votacion->id}}">
                                        <input type="hidden" name="candidato_id" value="{{$candidato->id}}">
                                    </form>
                                    </td>
                                    <td>{{ $candidato->nombre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Votaciones ya participados') }}</div>

                @foreach($votaciones as $votacion)
                @if($votosPersonales->contains('votacion_id', $votacion->id))
                    <!-- Si el usuario ya votó en la votación, mostrar total de votos -->
                    <div class="card-body m-2 p-2 bg-primary text-white text-center">
                    
                    <h1>{{ $votacion->titulo }}</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Total de votos</th>
                                <th>Candidato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votacion->candidatos as $candidato)
                                <tr>
                                    <td>
                                    @php
                                        $votos = $candidato->votos->where('votacion_id', $votacion->id)->count();
                                    @endphp
                                    {{ $votos }}
                                    </td>
                                    <td>{{ $candidato->nombre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
