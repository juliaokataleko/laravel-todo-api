@extends('layouts.admin')

@section('title', "Atualizar Dados do Funcionário: {$employer->name} " . config('app.name', 'Laravel'))

@section('content')

<style>
    .col-md-4 i, .col-md-12 i {
        font-size: 40px;
        color: #e67e22
    }
</style>

<div class="container bg-white px-4 py-4 border">
<h1 class="text-danger">Atualizar Dados do Funcionário: {{ $employer->name }}</h1>

<hr>

<form method="POST" 
enctype="multipart/form-data" action="/admin/employer/update/{{ $employer->id }}">
<div class="row">

    <div class="col-md-4">
        
            @csrf
            <div class="form-group">
                
                <div class="">
                    <label for="name">Nome</label>
                    <input id="name" placeholder="Nome:" type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name"
                    value="{{ old('name') ?? $employer->name }}"
                    required autocomplete="name" autofocus>
                    

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        

            <div class="custom-file mb-4 mt-3">
                <input type="file" class="custom-file-input" 
                id="validatedCustomFile" name="photo">
                <label class="custom-file-label" 
                for="validatedCustomFile">Escolhe uma foto...</label>
                <div class="invalid-feedback">
                    Ficheiro inválido
                </div>
            </div>

            <div class="form-group">
                
                <div class="">
                    <label for="email">E-mail</label>
                    <input id="email" placeholder="E-mail:" type="text" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email"
                    value="{{ old('email') ?? $employer->email  }}"
                    required autocomplete="name" autofocus>
                    

                    @error('email')
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
                    value="{{ old('username') ?? $employer->username  }}"
                    required autocomplete="off">
                 
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group">
                
                <div class="">
                    <label for="password">Senha</label>
                    <input id="password" placeholder="Digite a senha do cliente" 
                    type="text" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                    value="{{ old('password') }}"
                     autocomplete="off">
                 
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group">                
                <div class="">
                    <label for="phone">Telefone</label>
                    <input id="phone" placeholder="Telefone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                    name="phone" value="{{ old('phone') ?? $employer->phone  }}"
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
                    <label for="celular">Celular</label>
                    <input id="celular" placeholder="Telefone" type="text" class="form-control @error('celular') is-invalid @enderror" 
                    name="celular" value="{{ old('celular') ?? $employer->celular  }}"
                    autocomplete="off">

                    @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
    </div>

   
    <div class="col-md-4">

        <div class="form-group">                
            <div class="">
                <label for="birth_day">Data de Aniversário</label>
                <input id="birth_day"
                placeholder="Aniversário" type="date" 
                class="form-control @error('birth_day') is-invalid @enderror" 
                name="birth_day" value="{{ date('Y-m-d', strtotime($employer->birth_day . " + 0 months")) ?? old('birth_day') }}" 
                autocomplete="off">

                @error('birth_day')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <label for="" class="mt-1">Gênero</label> <br>

        <div class="form-check form-check-inline">
            <input class="form-check-input"  {{ (old('gender') == 'm' || $employer->gender == 'm' ) ? 'checked': '' }} type="radio" name="gender" id="gender1" value="m">
            <label class="form-check-label" for="gender1">Masculino</label>
        </div>

        <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="gender" {{ (old('gender') == 'f'  || $employer->gender == 'f') ? 'checked': '' }} id="gender2" value="f">
            <label class="form-check-label" for="gender2">Femenino</label>
        </div>

        <div class="form-group">
            <label for="pai">Nome do Pai</label>
            <input type="text" class="form-control" id="pai"
            value="{{ old('pai')?? $employer->pai }}"
            name="pai" placeholder="">
        </div>

        <div class="form-group">
            <label for="mae">Nome da Mãe</label>
            <input type="text" value="{{ old('mae') ?? $employer->mae }}" class="form-control" id="mae" name="mae">
        </div>

        <div class="form-group">
            <label for="civil">Estado civil</label>
            <select class="form-control" id="civil" name="civil">
                <option value="0">Selecione</option>
                <option value="1" {{ ($employer->civil == 1) ? 'selected' : '' }}>Casado</option>
                <option value="2" {{ ($employer->civil == 2) ? 'selected' : '' }}>Solteiro</option>
                <option value="3" {{ ($employer->civil == 3) ? 'selected' : '' }}>Divorciado</option>
                <option value="4" {{ ($employer->civil == 4) ? 'selected' : '' }}>União estável</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado"><small class="text-danger">*</small> Estado</label>
            <select class="form-control action" id="state_id" 
            name="state_id" required>
                <option value="" selected disabled>Selecione um estado</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}"  {{ ($employer->state->id == $state->id) ? 'selected' : '' }}>{{ $state->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cidade"><small class="text-danger">*</small> Cidade</label>
            <select class="form-control " id="city_id" 
            name="city_id" required>
            <option value="{{ $employer->city->id }}">{{ $employer->city->nome }}</option>
            </select>
        </div>

    </div>

    <div class="col-md-4">

        <div class="form-group">
            <label for="bairro"><small class="text-danger">*</small> Bairro</label>
            <input type="text" value="{{ old('bairro') ?? $employer->bairro }}" class="form-control" id="bairro" name="bairro" placeholder="" required>
        </div>

    </div>

    <div class="col-md-12">
        <hr>
        <div class="form-group mb-0">
            <div class="">
                <button type="submit" class="btn 
                form-control btn-primary">
                    Cadastrar
                </button>
            </div>
        </div>
    </div>

</div>
</form>

</div>

<script>
    $(function() {

        $("#phone").inputmask("(99) 9999-9999");
        $("#celular").inputmask("(99)9.9999-9999");
        $("#cep").inputmask("99999-999");

        //$('#example').append("Texto para aquele div");
        $('#state_id').change(function(e) {
            console.log(e);
            const state_id = e.target.value;
            // ajax
            $.get('/admin/city?state_id=' + state_id, function(data){
            //console.log(data);
            $('#city_id').empty();
            $.each(data, function(index, cityObj) {
                $('#city_id').append('<option value="'+cityObj.id+'">'+cityObj.nome+'</option>');
            });
            });
        })
    })
    
  </script>

@endsection
