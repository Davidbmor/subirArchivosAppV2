<!-- resources/views/archivos/create.blade.php -->
@extends('layout')

@section('title', 'Subir Imágenes')

@section('content')
    <h1>Subir Imágenes</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form id="upload-form" action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="drop-area" class="drop-area">
            <p>Arrastra y suelta tus archivos aquí o haz clic para seleccionar archivos</p>
            <input type="file" name="archivos[]" id="archivo" accept="image/*" multiple required>
        </div>
        <div id="preview-container" class="preview-container"></div>
        <button type="submit" class="upload-button">Subir</button>
    </form>
@endsection

@section('scripts')
<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('archivo');
    const previewContainer = document.getElementById('preview-container');

    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragover');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('dragover');
        fileInput.files = event.dataTransfer.files;
        showPreviews(fileInput.files);
    });

    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            showPreviews(fileInput.files);
        }
    });

    function showPreviews(files) {
        previewContainer.innerHTML = '';
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewImage = document.createElement('img');
                previewImage.src = e.target.result;
                previewImage.classList.add('preview-image');
                const previewText = document.createElement('p');
                previewText.classList.add('preview-text');
                previewText.textContent = `Imagen elegida: ${file.name}`;
                const previewWrapper = document.createElement('div');
                previewWrapper.classList.add('preview-wrapper');
                previewWrapper.appendChild(previewText);
                previewWrapper.appendChild(previewImage);
                previewContainer.appendChild(previewWrapper);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection