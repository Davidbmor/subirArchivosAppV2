<!-- resources/views/archivos/table.blade.php -->
@extends('layout')

@section('title', 'Tabla de Imágenes')

@section('content')
    <h1>Tabla de Imágenes</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Original</th>
                <th>Nombre</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archivos as $archivo)
                <tr>
                    <td>{{ $archivo->id }}</td>
                    <td>{{ $archivo->nombre_original }}</td>
                    <td>{{ $archivo->nombre }}</td>
                    <td>{{ $archivo->created_at }}</td>
                    <td>
                        <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm('¿Estás seguro de que deseas borrar este archivo? Esta acción no se puede deshacer.');
    }
</script>
@endsection