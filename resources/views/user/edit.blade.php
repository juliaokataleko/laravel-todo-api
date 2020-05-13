@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - Editar Minha Conta')

@section('content')
<div class="container mt-4" style="max-width: 500px">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @elseif(Session::has('warning'))
        <p class="alert alert-warning">{{ Session::get('warning') }}</p>
    @endif
    <div class="row mb-3" style="display: flex; align-items: center">
        <div class="col-sm-12">            
            <h3>Editar Perfil</h3>
        </div>
    </div>
    
    <div class="">
        <form method="POST" action="/profile/edit">
            @csrf
            <div class="form-group">
                
                <div class="">
                    <label for="name">Nome</label>
                    <input id="name" placeholder="Nome:" type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name"
                    value="{{ $user->name }}"
                    required autocomplete="name" autofocus>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        O seu nome deve conter apenas letras
                      </small>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                
                <div class="">
                    <label for="username">Usuário</label>
                    <input id="username" placeholder="Nome de usuário" 
                    type="text" 
                    class="form-control @error('username') is-invalid @enderror" 
                    name="username" 
                    value="{{ $user->username }}"
                    required autocomplete="off">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        O usuário não deve conter espaços ou caracteres especiais. Apenas letras, números e underline(_)
                      </small>

                    {{-- @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>
            </div>

            <div class="form-group">                
                <div class="">
                    <label for="phone">Telefone</label>
                    <input id="phone" placeholder="Telefone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                    name="phone" value="{{ $user->phone }}"
                    autocomplete="off">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">                
                <div class="">
                    <label for="birth_day">Data de Aniversário</label>
                    <input id="birth_day" placeholder="Aniversário" type="date" 
                    class="form-control @error('birth_day') is-invalid @enderror" 
                    name="birth_day" value="{{ $user->birth_day }}" 
                    autocomplete="off">

                    @error('birth_day')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <label for="">Gênero</label> <br>

            <div class="form-check form-check-inline">
                <input class="form-check-input"  {{ ($user->gender == 'm') ? 'checked': '' }} type="radio" name="gender" id="gender1" value="m">
                <label class="form-check-label" for="gender1">Masculino</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" {{ ($user->gender == 'f') ? 'checked': '' }} id="gender2" value="f">
                <label class="form-check-label" for="gender2">Femenino</label>
            </div>

            <hr>

            <div class="form-group mb-0">
                <div class="">
                    <button type="submit" class="btn form-control btn-primary">
                        Actualizar
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
