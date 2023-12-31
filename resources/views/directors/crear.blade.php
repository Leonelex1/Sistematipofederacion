@extends('layouts/app')
@section('titulo', 'Registro Administrador')
@section('content')
    @if (Auth::user()->tipo == 1)
        @if (session('correcto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'CORRECTO',
                        type: 'success',
                        text: "{{ session('correcto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif
        @if (session('incorrecto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif

        @if (session('duplicado'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('duplicado') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif

        <div class="modal-body" id="modal-create">
            <h3 class="text-center" style="margin-bottom: 55px">REGISTRO DE NUEVO ADMNISTRADOR</h3>
            <form action="{{ route('directors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row col-12">
                    <div class="col-xs-12 col-md-6">
                        @error('dni')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="number" placeholder="Clave" name="dni" id="dni" value="{{ old('dni') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('nombre')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" placeholder="Nombre" id="nombre" name="nombre" value="{{ old('nombre') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('apellido')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" placeholder="Apellido" id="apellido" name="apellido"
                            value="{{ old('apellido') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('email')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="email" placeholder="Correo" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('clave')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="password" placeholder="Contraseña *" id="clave" name="clave"
                            value="{{ old('clave') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('clave2')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="password" placeholder="Repite la contraseña *" id="clave2" name="clave2"
                            value="{{ old('clave2') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('direccion')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" placeholder="Direccion" name="direccion" value="{{ old('direccion') }}">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @error('telefono')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="number" placeholder="Numero de telefono" name="telefono" value="{{ old('telefono') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('directors.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                    <button type="submit" id="boton" class="btn btn-primary">REGISTRAR</button>
                </div>
            </form>
        </div>
        <script>
            var boton = document.getElementById("boton");
            $("#dni").change(function() {
                var dni = document.getElementById("dni").value;
                fetch('https://dni.optimizeperu.com/api/persons/' + dni).then(res => res.json()).then(data => {
                    document.getElementById("nombre").value = (data.name);
                    document.getElementById("apellido").value = (data.first_name + " " + data.last_name);
                });
            })

            //OJO ESTE CODIGO E EJECUTA SI LA PAGINA NO ES HTTPS
            // $("#dni").change(function() {
            //     var dni = document.getElementById("dni").value;
            //     fetch('http://zekasystem.xyz/api/dni2?dni=' + dni).then(res => res.json()).then(data => {
            //         document.getElementById("nombre").value = (data.nombres);
            //         document.getElementById("apellido").value = (data.apellido_paterno + " " + data
            //             .apellido_materno);
            //     });
            // })

        </script>
    @endif
@endsection
