<html lang="en">
    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
<body>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Veterinaria</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('inicioruta')}}" aria-current="page"
                        >Clientes
                        <span class="visually-hidden">(current)</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('inicioruta')}}" aria-current="page"
                        >Perros
                        <span class="visually-hidden">(current)</span></a
                    >
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
<table class="table">
    <thead>
        <th>id</th>
        <th>nombre</th>
        <th>direccion</th>
        <th>Modificar/Eliminar</th>
    </thead>
    <tbody>
        @foreach ($personas as $persona)
        <tr>
            <td>{{$persona->id}}</td>
            <td>{{$persona->nombre}}</td>
            <td>{{$persona->direccion}}</td>
            <td>
                <button type="button" class="btn btn-danger">✎</button>
                <button type="button" class="btn btn-danger">🗑</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="container">
    <h1>Dar de alta cliente</h1>
    <form action="{{route('persona.nuevo')}}" method="post">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" class="form-control">
        <input type="text" name="direccion" placeholder="Direccion" class="form-control">
        <button type="submit" class="btn btn-success">Crear</button>
    </form>
</div>


</body>
</html>