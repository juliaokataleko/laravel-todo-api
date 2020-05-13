@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - Editar Foto de Perfil')

@section('content')
<div class="container mt-4">
    <div class="row" style="display: flex; align-items: center">
        
        <div class="col-sm-3">
            <?php
            if(!null == Auth::user()->avatar && file_exists('uploads/avatar/'.Auth::user()->avatar)): ?>
                <img style="width: 200px; height: 200px; object-fit: cover; " src="/uploads/avatar/{{ Auth::user()->avatar }}" 
                class="rounded mb-4 border" alt="...">
            <?php else: ?>
                <img style="width: 100%; max-width: 220px;" src="/images/person.png" 
                class="rounded mb-4 border" alt="...">
            <?php endif; ?>
        </div>
        <div class="col-sm-8">
            <h3>Editar Foto de Perfil</h3>
            <form enctype="multipart/form-data" action="/profile/photo" method="post">
                @csrf
                <div class="custom-file">
                <input type="file" class="custom-file-input" 
                id="validatedCustomFile" name="photo" required>
                <label class="custom-file-label" 
                for="validatedCustomFile">Escolhe uma foto...</label>
                <div class="invalid-feedback">
                    Ficheiro inválido
                </div>
                </div>
                <button type="submit" class="mt-3 btn btn-success">Actualizar Foto</button>
            </form>
        </div>
    </div>
    
</div>
@endsection
