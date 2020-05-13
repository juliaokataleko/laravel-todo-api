@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Por favor verifique seu endereço de email para activar sua conta</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Foi enviado um link de verificação no seu emai..') }}
                        </div>
                    @endif

                    {{ __('Antes de prosseguir, por favor verifique seu email.') }}
                    {{ __('Senão recebeste ainda o email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary d-block">{{ __(' clique aqui para reenviar') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
