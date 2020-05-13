@extends('layouts.admin')

@section('title', 'Configurações - ' . config('app.name', 'Laravel'))

@section('content')

<style>
    .col-md-4 i, .col-md-12 i {
        font-size: 40px;
        color: #e67e22
    }
</style>

<div class="container bg-white px-4 py-4">
    <h2>CONFIGURAÇÕES</h2>
    <a href="/admin">Painel</a>

    @if(Session::has('success'))
        <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
    @elseif(Session::has('warning'))
        <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
    @endif

    <form action="/admin/config" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row mt-4">

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" 
                    placeholder="Nome do Loja"
                    class="form-control"
                    value="{{ $config->name }}"
                    name="name" id="name">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" 
                    placeholder="Email"
                    class="form-control"
                    value="{{ $config->email }}"
                    name="email" id="email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Endereço</label>
                    <input type="url" 
                    class="form-control"
                    placeholder="URL da Loja"
                    value="{{ $config->url }}"
                    name="url" id="url">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Por Página</label>
                    <select name="num_pages" id="num_pages" 
                    class="form-control">
                        <option {{ ($config->num_pages == 10) ? 'selected' : '' }} value="10">10</option>
                        <option value="20"{{ ($config->num_pages == 20) ? 'selected' : '' }}>20</option>
                        <option value="50" {{ ($config->num_pages == 50) ? 'selected' : '' }}>50</option>
                        <option value="100" {{ ($config->num_pages == 100) ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12"  style="display:none">
                <div class="form-group">
                    <textarea
                    class="form-control"
                    name="about" id="about" 
                    placeholder="Sobre A Loja">{{ $config->about }}</textarea>
                </div>
            </div>

            <div class="col-md-12" style="display:none">
                <div class="form-group">
                    <textarea
                    class="form-control"
                    name="privacy_policy" id="privacy_policy" 
                    placeholder="Política de Privacidade">{{ $config->privacy_policy }}</textarea>
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label for="estado"><small class="text-danger">*</small> Estado</label>
                <select class="form-control action" id="state_id" 
                name="state_id" required>
                    <option value="" selected disabled>Selecione um estado</option>
                    @foreach ($states as $state)
                    <option value="{{ $state->id }}"  {{ ($config->state->id == $state->id) ? 'selected' : '' }}>{{ $state->nome }}</option>
                @endforeach
                </select>
            </div>
    
            <div class="col-md-6 form-group">
                <label for="cidade"><small class="text-danger">*</small> Cidade</label>
                <select class="form-control " id="city_id" 
                name="city_id" required>
                <option value="{{ $config->city->id }}">{{ $config->city->nome }}</option>
                </select>
            </div>   

            <div class="col-md-3">
                <label for="" class="mt-1">Bloqueio Automático</label> <br>
        
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  
                    {{ (old('auto_block') == '1' || $config->auto_block == 1) ? 'checked': '' }} 
                    type="radio" name="auto_block" id="block1" value="1">
                    <label class="form-check-label" for="block1">Sim</label>
                </div>
        
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="radio" 
                    name="auto_block" {{ (old('auto_block') == '0'  || $config->auto_block == 0) ? 'checked': '' }} 
                    id="block2" value="0">
                    <label class="form-check-label" for="block2">Não</label>
                </div>
            </div>

            <div class="col-md-3">
                <label for="peirodo">Período</label>
                <select class="form-control " id="periodo" name="periodo">
                    <option value="1" <?php if ((int) $config->periodo == 1) {
                                            echo "selected";
                                        } ?>>Mensal</option>
                    <option value="2" <?php if ((int) $config->periodo == 2) {
                                            echo "selected";
                                        } ?>>Bimestral</option>
                    <option value="3" <?php if ((int) $config->periodo == 3) {
                                            echo "selected";
                                        } ?>>Trimestral</option>
                    <option value="6" <?php if ((int) $config->periodo == 6) {
                                            echo "selected";
                                        } ?>>Semestral</option>
                    <option value="12" <?php if ((int) $config->periodo == 12) {
                                            echo "selected";
                                        } ?>>Anual</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="dia">Dia</label>
                <select class="form-control " id="dia" name="dia">
                    <?php
                    for ($i = 0; $i < 29; $i++) : ?>
                        <option value="<?= $i; ?>" 
                            <?php if ((int) $config->dia == $i) {
                                echo "selected";
                            } ?>><?= $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">                
                    <div class="">
                        <label for="celular">Celular</label>
                        <input id="phone" placeholder="Telefone" type="text" class="form-control @error('celular') is-invalid @enderror" 
                        name="celular" value="{{ old('celular') ?? $config->celular }}"
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
                <label for="dia">Dias De Atraso</label>
                <select class="form-control " id="dias_atraso" name="dias_atraso">
                    <?php
                    for ($i = 0; $i < 29; $i++) : ?>
                        <option value="<?= $i; ?>" 
                            <?php if ((int) $config->dias_atraso == $i) {
                                echo "selected";
                            } ?>><?= $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="dia">Multa em R$</label>
                <input type="text" name="taxa" value="{{ $config->taxa }}" id="taxa" class="form-control">
            </div>

            <div class="col-md-4 form-group">
                <label for="validatedCustomFile">Logo</label> <br>
                <div>
                    <input type="file" class="mt-4 custom-file-input" 
                    id="validatedCustomFile" name="photo">
                    <label class="custom-file-label" 
                    for="validatedCustomFile">Escolhe uma foto...</label>
                    <div class="invalid-feedback">
                        Ficheiro inválido
                    </div>
                </div>
                
            </div>

            <div class="col-md-3">
                <div class="form-group">                
                    <div class="">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" placeholder="Telefone" type="text" class="form-control @error('celular') is-invalid @enderror" 
                        name="telefone" value="{{ old('telefone') ?? $config->telefone }}"
                        autocomplete="off">
        
                        @error('telefone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <label for="razao_social">Razão Social</label>
                <input type="text" name="razao_social" value="{{ old('razao_social') ?? $config->razao_social }}" class="form-control">
            </div>


            <div class="col-md-12">
                <button class="btn btn-primary" >Salvar</button>
            </div>

        </div>

    </form>

</div>

<script>
$(function() {
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
