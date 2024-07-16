<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="text-center">
        <h1>Vista de administrador</h1>
        <h5>Para ser un votante registrate o haz login en el navbar</h5>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Votaciones') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Dar de alta Votacion</h1>
                        <form action="{{route('votaciones.create')}}" method="post">
                        @csrf
                            <input type="text" name="titulo" placeholder="Titulo" class="form-control">
                            <button type="submit" class="btn btn-success mt-2">Crear</button>
                        </form>
                    </div>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Candidatos (#num de votos)</th>
                                <th>Agregar candidato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votaciones as $votacion)
                                <tr>
                                    <td>{{ $votacion->id }}</td>
                                    <td>{{ $votacion->titulo }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($votacion->candidatos as $candidato)
                                                <li>
                                                    @php
                                                        $votos = $candidato->votos->where('votacion_id', $votacion->id)->count();
                                                    @endphp
                                                    ({{ $votos }})
                                                    {{ $candidato->nombre }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <form action="{{route('candidatos.create')}}" method="post" class="d-flex align-items-center">
                                        @csrf
                                            <button type="submit" class="btn btn-primary mr-4">+</button>
                                            <input type="text" name="nombre" placeholder="Nombre de candidato" class="form-control">
                                            <input type="hidden" name="votacion_id" value="{{$votacion->id}}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
</div>
@endsection
</body>
</html>