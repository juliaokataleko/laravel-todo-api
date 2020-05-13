@extends('layouts.app')

@section('content')
<div class="container " style="max-width: 500px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <div class="text-center">
                        <?php
                        if(!null == $config->logo && 
                        file_exists('uploads/config/'.$config->logo)): ?>
                          <img style="width: 140px; height: 140px;
                          object-fit: cover; display: inline" 
                          src="/uploads/config/{{ $config->logo }}" 
                          class="rounded" alt="{{ $config->name }}">
                        <?php endif; ?>
                      </div>
                      <h4 class="text-center px-3">Acessa a sua conta!</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="login" type="text" 
                                placeholder="Usuário ou E-mail" 
                                class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                name="login" value="{{ old('username') ?: old('email') }}"
                                required autocomplete="off" autofocus>

                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" placeholder="Senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if (Route::has('password.request'))
                                    <a class="mt-2 btn-link" href="{{ route('password.request') }}">
                                        Esquecí a minha senha.
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Manter a sessão
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn form-control btn-primary">
                                    Entrar
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
