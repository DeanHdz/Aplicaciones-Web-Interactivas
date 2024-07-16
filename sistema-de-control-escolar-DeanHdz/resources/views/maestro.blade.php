<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maestro</title>
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Aqui se genera el @csrf token para no batallar en ponerlo en el boton directamente, el script de abajo lo recupera de aqui-->
        @include('partials.bootstrap')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var generatePdfButtons = document.querySelectorAll('.generatePdfButton');

                generatePdfButtons.forEach(function (button) {
                    button.addEventListener('click', function () {

                        // Extrae el HTML del grupo correspondiente, empezando desde el nombre de grupo para abajo
                        var groupDivId = button.getAttribute('data-group-id');
                        var groupDiv = document.getElementById(groupDivId);
                        var groupHtml = groupDiv.outerHTML;

                        // El controlador espera un JSON con la propiedad "html" que contiene el HTML del grupo
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "{{ route('generate.pdf') }}");
                        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                        // Include CSRF token in the request headers
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

                        xhr.responseType = "blob"; // Treat response as binary data

                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                var blob = new Blob([xhr.response], { type: 'application/pdf' });
                                var link = document.createElement('a');
                                link.href = window.URL.createObjectURL(blob);
                                link.download = 'boletaCalificaciones_GrupoId' + groupDivId + '.pdf'; // Nombre del archivo
                                link.click();
                            }
                        };

                        xhr.send(JSON.stringify({ html: groupHtml })); //Manda el HTML del grupo al controlador PDFController
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                var importExcelButtons = document.querySelectorAll('.importExcelButton');

                importExcelButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        var groupId = button.getAttribute('data-group-id');
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('import.excel') }}";
                        form.enctype = 'multipart/form-data';

                        // Include CSRF token in the request headers
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        var csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;

                        var groupIdInput = document.createElement('input');
                        groupIdInput.type = 'hidden';
                        groupIdInput.name = 'grupo_id';
                        groupIdInput.value = groupId;

                        var fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'file';

                        var submitButton = document.createElement('button');
                        submitButton.type = 'submit';
                        submitButton.innerText = 'Importar';

                        form.appendChild(csrfInput);
                        form.appendChild(groupIdInput);
                        form.appendChild(fileInput);
                        form.appendChild(submitButton);

                        form.style.display = 'none';
                        document.body.appendChild(form);

                        submitButton.click();
                    });
                });
            });
        </script>
    </head>

    <body class="w-100 bg-light">
        <header class="container-fluid p-4 text-center text-white bg-dark">
            <h1>Sistema de control escolar</h1>
            <h4>¡Bienvenido Maestro(a) {{ $maestro->name }}!</h4>
            <p>(id: {{ $maestro->id }})</p>
            <a href="{{ route('sesion.end') }}">
                <button
                    class="btn btn-primary"
                >
                    Cerrar sesión
                </button>
            </a>
        </header>

        <main class="mt-6">
            
            <div class="container bg-success rounded-pill p-2 border mt-4">
                <h2 class="text-white text-center">Grupos impartidos</h2>
            </div>

            @foreach($grupos as $grupo)
                @php
                    $inscripciones = \App\Models\Inscripcion::where('grupo_id', $grupo->id)->get();
                @endphp
                @if($inscripciones->count() == 0)
                    <div class="container bg-light p-2 border mt-4">
                        <h3>Grupo: {{ $grupo->nombre }}</h3>
                        <p>No hay alumnos inscritos en este grupo</p>
                    </div>
                @else
                <div class="container bg-light p-2 border mt-4">

                    <div class="d-flex justify-content-evenly">
                        
                        <div>
                        <button class="importExcelButton btn border" data-group-id="{{ $grupo->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32"><defs><linearGradient id="vscodeIconsFileTypeExcel0" x1="4.494" x2="13.832" y1="-2092.086" y2="-2075.914" gradientTransform="translate(0 2100)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#18884f"/><stop offset=".5" stop-color="#117e43"/><stop offset="1" stop-color="#0b6631"/></linearGradient></defs><path fill="#185c37" d="M19.581 15.35L8.512 13.4v14.409A1.192 1.192 0 0 0 9.705 29h19.1A1.192 1.192 0 0 0 30 27.809V22.5Z"/><path fill="#21a366" d="M19.581 3H9.705a1.192 1.192 0 0 0-1.193 1.191V9.5L19.581 16l5.861 1.95L30 16V9.5Z"/><path fill="#107c41" d="M8.512 9.5h11.069V16H8.512Z"/><path d="M16.434 8.2H8.512v16.25h7.922a1.2 1.2 0 0 0 1.194-1.191V9.391A1.2 1.2 0 0 0 16.434 8.2" opacity="0.1"/><path d="M15.783 8.85H8.512V25.1h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191" opacity="0.2"/><path d="M15.783 8.85H8.512V23.8h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191" opacity="0.2"/><path d="M15.132 8.85h-6.62V23.8h6.62a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191" opacity="0.2"/><path fill="url(#vscodeIconsFileTypeExcel0)" d="M3.194 8.85h11.938a1.193 1.193 0 0 1 1.194 1.191v11.918a1.193 1.193 0 0 1-1.194 1.191H3.194A1.192 1.192 0 0 1 2 21.959V10.041A1.192 1.192 0 0 1 3.194 8.85"/><path fill="#fff" d="m5.7 19.873l2.511-3.884l-2.3-3.862h1.847L9.013 14.6c.116.234.2.408.238.524h.017c.082-.188.169-.369.26-.546l1.342-2.447h1.7l-2.359 3.84l2.419 3.905h-1.809l-1.45-2.711A2.355 2.355 0 0 1 9.2 16.8h-.024a1.688 1.688 0 0 1-.168.351l-1.493 2.722Z"/><path fill="#33c481" d="M28.806 3h-9.225v6.5H30V4.191A1.192 1.192 0 0 0 28.806 3"/><path fill="#107c41" d="M19.581 16H30v6.5H19.581Z"/></svg>
                        <p>Subir calificaciones</p>
                        </button>
                        </div>
                    

                        <div>
                        <form method="POST" action="{{ route('calificaciones.delete') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 512 512"><path fill="#ff473e" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg>
                                <p>Borrar calificaciones</p>
                            </button>
                            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                        </form>
                        </div>
                    
                        <div>
                        <button class="generatePdfButton btn border" data-group-id="{{ $grupo->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32"><path fill="#909090" d="m24.1 2.072l5.564 5.8v22.056H8.879V30h20.856V7.945z"/><path fill="#f4f4f4" d="M24.031 2H8.808v27.928h20.856V7.873z"/><path fill="#7a7b7c" d="M8.655 3.5h-6.39v6.827h20.1V3.5z"/><path fill="#dd2025" d="M22.472 10.211H2.395V3.379h20.077z"/><path fill="#464648" d="M9.052 4.534H7.745v4.8h1.028V7.715L9 7.728a2.042 2.042 0 0 0 .647-.117a1.427 1.427 0 0 0 .493-.291a1.224 1.224 0 0 0 .335-.454a2.13 2.13 0 0 0 .105-.908a2.237 2.237 0 0 0-.114-.644a1.173 1.173 0 0 0-.687-.65a2.149 2.149 0 0 0-.409-.104a2.232 2.232 0 0 0-.319-.026m-.189 2.294h-.089v-1.48h.193a.57.57 0 0 1 .459.181a.92.92 0 0 1 .183.558c0 .246 0 .469-.222.626a.942.942 0 0 1-.524.114m3.671-2.306c-.111 0-.219.008-.295.011L12 4.538h-.78v4.8h.918a2.677 2.677 0 0 0 1.028-.175a1.71 1.71 0 0 0 .68-.491a1.939 1.939 0 0 0 .373-.749a3.728 3.728 0 0 0 .114-.949a4.416 4.416 0 0 0-.087-1.127a1.777 1.777 0 0 0-.4-.733a1.63 1.63 0 0 0-.535-.4a2.413 2.413 0 0 0-.549-.178a1.282 1.282 0 0 0-.228-.017m-.182 3.937h-.1V5.392h.013a1.062 1.062 0 0 1 .6.107a1.2 1.2 0 0 1 .324.4a1.3 1.3 0 0 1 .142.526c.009.22 0 .4 0 .549a2.926 2.926 0 0 1-.033.513a1.756 1.756 0 0 1-.169.5a1.13 1.13 0 0 1-.363.36a.673.673 0 0 1-.416.106m5.08-3.915H15v4.8h1.028V7.434h1.3v-.892h-1.3V5.43h1.4v-.892"/><path fill="#dd2025" d="M21.781 20.255s3.188-.578 3.188.511s-1.975.646-3.188-.511m-2.357.083a7.543 7.543 0 0 0-1.473.489l.4-.9c.4-.9.815-2.127.815-2.127a14.216 14.216 0 0 0 1.658 2.252a13.033 13.033 0 0 0-1.4.288Zm-1.262-6.5c0-.949.307-1.208.546-1.208s.508.115.517.939a10.787 10.787 0 0 1-.517 2.434a4.426 4.426 0 0 1-.547-2.162Zm-4.649 10.516c-.978-.585 2.051-2.386 2.6-2.444c-.003.001-1.576 3.056-2.6 2.444M25.9 20.895c-.01-.1-.1-1.207-2.07-1.16a14.228 14.228 0 0 0-2.453.173a12.542 12.542 0 0 1-2.012-2.655a11.76 11.76 0 0 0 .623-3.1c-.029-1.2-.316-1.888-1.236-1.878s-1.054.815-.933 2.013a9.309 9.309 0 0 0 .665 2.338s-.425 1.323-.987 2.639s-.946 2.006-.946 2.006a9.622 9.622 0 0 0-2.725 1.4c-.824.767-1.159 1.356-.725 1.945c.374.508 1.683.623 2.853-.91a22.549 22.549 0 0 0 1.7-2.492s1.784-.489 2.339-.623s1.226-.24 1.226-.24s1.629 1.639 3.2 1.581s1.495-.939 1.485-1.035"/><path fill="#909090" d="M23.954 2.077V7.95h5.633z"/><path fill="#f4f4f4" d="M24.031 2v5.873h5.633z"/><path fill="#fff" d="M8.975 4.457H7.668v4.8H8.7V7.639l.228.013a2.042 2.042 0 0 0 .647-.117a1.428 1.428 0 0 0 .493-.291a1.224 1.224 0 0 0 .332-.454a2.13 2.13 0 0 0 .105-.908a2.237 2.237 0 0 0-.114-.644a1.173 1.173 0 0 0-.687-.65a2.149 2.149 0 0 0-.411-.105a2.232 2.232 0 0 0-.319-.026m-.189 2.294h-.089v-1.48h.194a.57.57 0 0 1 .459.181a.92.92 0 0 1 .183.558c0 .246 0 .469-.222.626a.942.942 0 0 1-.524.114m3.67-2.306c-.111 0-.219.008-.295.011l-.235.006h-.78v4.8h.918a2.677 2.677 0 0 0 1.028-.175a1.71 1.71 0 0 0 .68-.491a1.939 1.939 0 0 0 .373-.749a3.728 3.728 0 0 0 .114-.949a4.416 4.416 0 0 0-.087-1.127a1.777 1.777 0 0 0-.4-.733a1.63 1.63 0 0 0-.535-.4a2.413 2.413 0 0 0-.549-.178a1.282 1.282 0 0 0-.228-.017m-.182 3.937h-.1V5.315h.013a1.062 1.062 0 0 1 .6.107a1.2 1.2 0 0 1 .324.4a1.3 1.3 0 0 1 .142.526c.009.22 0 .4 0 .549a2.926 2.926 0 0 1-.033.513a1.756 1.756 0 0 1-.169.5a1.13 1.13 0 0 1-.363.36a.673.673 0 0 1-.416.106m5.077-3.915h-2.43v4.8h1.028V7.357h1.3v-.892h-1.3V5.353h1.4v-.892"/></svg>                        
                            <p>Descargar PDF</p>
                        </button>
                        </div>
                    </div>

                    <div id="{{ $grupo->id }}">
                    <h2 class="mt-2 mb-2">Grupo: {{ $grupo->nombre }}</h2>
                    <div class="row">
                    <div class="col-12">
                        <h4>Alumnos</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Clave Única</th>
                                    <th>Nombre</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscripciones as $inscripcion)
                                    @php
                                        $alumno = \App\Models\Alumno::where('id', $inscripcion->alumno_id)->first();
                                        $calificacion = \App\Models\Calificacion::where([
                                            ['grupo_id', $inscripcion->grupo_id],
                                            ['alumno_id', $inscripcion->alumno_id],
                                        ])->first();
                                    @endphp

                                    @if($alumno)
                                        <tr>
                                            <td>{{ $alumno->clave_unica }}</td>
                                            <td>{{ $alumno->nombre }}</td>
                                            @if($calificacion)
                                                <td>{{ $calificacion->calificacion }}</td>
                                            @else
                                                <td>Sin calificar</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    </div>
                    
                </div>
                @endif
            @endforeach

        </main>

    </body>

</html>
