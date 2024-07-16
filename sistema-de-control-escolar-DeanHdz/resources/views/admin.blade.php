<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        @include('partials.bootstrap')
    </head>

    <body class="w-100 bg-light">
        <header class="container-fluid p-4 text-center text-white bg-dark">
            <h1>Sistema de control escolar</h1>
            <p>Administrador</p>
            <a href="{{ route('home') }}">
                <button
                    class="btn btn-primary"
                >
                    Ir a inicio
                </button>
            </a>
        </header>

        <main class="mt-6">
            <div class="container bg-success rounded-pill p-2 border mt-4">
                <h2 class="text-white text-center">Registro (Dar de alta)</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2>Registrar materia</h2>
                        <form method="POST" action="{{ route('materias.create') }}">
                            @csrf
                            <div class="form-group
                            ">
                                <label for="nombre">Nombre</label>
                                <input
                                    id="nombre"
                                    type="text"
                                    name="nombre"
                                    required
                                    autofocus
                                    class="form-control"
                                />
                                <button type="submit" class="btn btn-success mt-2">Alta Materia</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <h2>Registrar grupo</h2>
                        <form method="POST" action="{{ route('grupos.create') }}">
                            @csrf
                            <div class="form-group
                            ">
                                <label for="nombre">Nombre (Materia-Horario-dias)</label>
                                <input
                                    id="nombre"
                                    type="text"
                                    name="nombre"
                                    required
                                    autofocus
                                    class="form-control"
                                />
                                <label for="maestro_id">Maestro</label>
                                <select
                                    id="maestro_id"
                                    name="maestro_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($maestros as $maestro)
                                        <option value="{{ $maestro->id }}">{{ $maestro->name }}</option>
                                    @endforeach
                                </select>
                                <label for="materia_id">Materia</label>
                                <select
                                    id="materia_id"
                                    name="materia_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success mt-2">Alta Grupo</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h2>Registrar alumno</h2>
                        <form method="POST" action="{{ route('alumnos.create') }}">
                            @csrf
                            <div class="form-group
                            ">
                                <label for="nombre">Nombre</label>
                                <input
                                    id="nombre"
                                    type="text"
                                    name="nombre"
                                    required
                                    autofocus
                                    class="form-control"
                                />
                                <label for="clave_unica">Clave Única</label>
                                <input
                                    id="clave_unica"
                                    type="text"
                                    name="clave_unica"
                                    required
                                    autofocus
                                    class="form-control"
                                />
                                <button type="submit" class="btn btn-success mt-2">Alta Alumno</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <h2>Inscribir alumno</h2>
                        <form method="POST" action="{{ route('inscripciones.create') }}">
                            @csrf
                            <div class="form-group
                            ">
                                <label for="alumno_id">Alumno</label>
                                <select
                                    id="alumno_id"
                                    name="alumno_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($alumnos as $alumno)
                                        <option value="{{ $alumno->id }}">{{ $alumno->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="grupo_id">Grupo</label>
                                <select
                                    id="grupo_id"
                                    name="grupo_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success mt-2">Inscribir alumno</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container bg-danger rounded-pill p-2 border mt-4">
                <h2 class="text-white text-center">Eliminación (Dar de baja)</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2>Eliminar materia</h2>
                        <form method="POST" action="{{ route('materias.delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group
                            ">
                                <label for="materia_id">Materia</label>
                                <select
                                    id="materia_id"
                                    name="materia_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-danger mt-2">Eliminar materia</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <h2>Eliminar grupo</h2>
                        <form method="POST" action="{{ route('grupos.delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group
                            ">
                                <label for="grupo_id">Grupo</label>
                                <select
                                    id="grupo_id"
                                    name="grupo_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-danger mt-2">Eliminar grupo</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h2>Eliminar alumno</h2>
                        <form method="POST" action="{{ route('alumnos.delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group
                            ">
                                <label for="alumno_id">Alumno</label>
                                <select
                                    id="alumno_id"
                                    name="alumno_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($alumnos as $alumno)
                                        <option value="{{ $alumno->id }}">{{ $alumno->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-danger mt-2">Eliminar alumno</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <h2>Eliminar inscripción</h2>
                        <form method="POST" action="{{ route('inscripciones.delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group
                            ">
                                <label for="inscripcion_id">Inscripción</label>
                                <select
                                    id="inscripcion_id"
                                    name="inscripcion_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($inscripciones as $inscripcion)
                                        @php
                                            $alumno = \App\Models\Alumno::find($inscripcion->alumno_id);
                                            $grupo = \App\Models\Grupo::find($inscripcion->grupo_id);
                                        @endphp

                                        @if ($alumno && $grupo)
                                            <option value="{{ $inscripcion->id }}">
                                                {{ $alumno->nombre }} / {{ $grupo->nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-danger mt-2">Baja de inscripción</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h2>Eliminar maestro</h2>
                        <form method="POST" action="{{ route('maestros.delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group
                            ">
                                <label for="maestro_id">Maestro</label>
                                <select
                                    id="maestro_id"
                                    name="maestro_id"
                                    required
                                    class="form-control"
                                >
                                    @foreach ($maestros as $maestro)
                                        <option value="{{ $maestro->id }}">{{ $maestro->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-danger mt-2">Eliminar maestro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>

</html>
