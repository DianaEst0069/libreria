<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')
    
    <h1>Libros registrados</h1>
    <br>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('libros.create') }}" class="btn btn-success mb-3 me-3">
            <i class="fa-solid fa-plus"></i>Nuevo libro
        </a>
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf 
            <button class="btn btn-danger me-3"><i class="fa-solid fa-arrow-right-to-bracket"></i>Cerrar sesión</button>
        </form>
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin-dashboard') }}" class="btn btn-secondary">
                Panel Admin
            </a>
        @endif
    </div>
    
    <br>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>AUTOR</th>
                <th>EDITORIAL</th>
                <th>PRECIO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <body>
            @foreach ($libros as $libro)
            <tr>
                <!-- Nombre de la BD -->
                <td>{{ $libro->id }} </td>
                <td>{{ $libro->nombre }} </td>
                <td>{{ $libro->autor }} </td>
                <td>{{ $libro->editorial }} </td>
                <td>{{ $libro->precio }} </td>
                <td>
                    <a href="{{ route('libros.edit', $libro) }}" class="btn btn-warning">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar el registro?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </form>
        
                </td>
            </tr>
            @endforeach
        </body>
    </table>

    @endsection


</body>
</html>