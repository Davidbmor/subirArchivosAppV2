<!-- resources/views/archivos/index.blade.php -->
@extends('layout')

@section('title', 'Index Page')

@section('content')
    <h1>Imágenes Almacenadas</h1>
    @if($archivos->isEmpty())
        <p>No hay imágenes almacenadas. <a href="{{ route('archivos.create') }}">Subir una imagen</a></p>
    @else
        <div class="gallery">
            @foreach($archivos as $archivo)
                <div class="gallery-item">
                    <a href="{{ route('archivos.show', $archivo->id) }}" class="gallery-link">
                        <img src="{{ route('archivos.show', $archivo->id) }}" alt="{{ $archivo->nombre_original }}" class="gallery-image">
                        <div class="overlay">
                            <div class="text">Ver imagen</div>
                        </div>
                    </a>
                    <p class="gallery-caption">{{ $archivo->nombre_original }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection