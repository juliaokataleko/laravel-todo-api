@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Planos')

@section('content')
<div class="container bg-white px-4 py-4 border">
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between" style="align-items: center">
                <h5 style="text-transform: uppercase">Lista de Planos: (Total {{ count($planos) }})</h5>    
                <?php 
                if(isset($_GET['query'])) {
                    $query = addslashes($_GET['query']);                    
                }                           
                ?>
                <form action="/admin/planos" method="get">
                    <div class="input-group mb-3">
                    <input type="search" 
                    class="form-control" 
                    name="query"
                    value="{{ (isset($query)) ? $query : '' }}"
                    placeholder="Pesquisar Plano">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" 
                        type="submit"> <i class="fa fa-search"></i> </button>
                    </div>
                    </div>
                </form>          
            </div>                 

        </div>

        <div class="col-md-12 boder">
            
                <!-- general form elements -->
        <div class="bg-white border mb-2" style="padding: 1em">


            <div class="box-header border-0">
                @if(isset($_GET['plano']))
                <h3 class="text-danger  text-uppercase">Atualizar Plano: {{ $plano->nome }} </h3>
                @else
                <h3 class="text-dark text-uppercase">Cadastrar Plano </h3>
                @endif
                
                <hr>
            </div>
            @if(isset($_GET['plano']))
            <form action="/admin/plano/update/{{$plano->id}}" autocomplete="off" method="post">
            @else
            <form action="/admin/plano/store" autocomplete="off" method="post">
            @endif
            
                @csrf

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" 
                                value="{{ old('nome') ?? $plano->nome }}"
                                id="nome" name="nome" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="text" class="form-control" 
                                value="{{ old('preco') ?? $plano->preco }}"
                                id="preco" name="preco" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="download">Download</label>
                                <input type="text" class="form-control" 
                                value="{{ old('download') ?? $plano->download }}"
                                id="download" name="download" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="upload">Upload</label>
                                <input type="text" class="form-control" 
                                value="{{ old('upload') ?? $plano->upload }}"
                                id="upload" name="upload" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="servidor_id">Servidor Mikrotik</label>
                                <select name="servidor_id" id="servidor_id" class="form-control">
                                    <option value="" disabled selected>Selecione</option>
                                    @if(!isset($_GET['plano'])) 
                                    <option value="" selected>Selecionar servidor

                                    </option>
                                    @else
                                    <option value="{{ $plano->server->id }}" selected>{{ $plano->server->nome }}

                                    </option>
                                    @endif
                                    @foreach ($servers as $server)
                                        <option value="{{ $server->id }}">{{ $server->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pool_id">Ip Pool</label>
                                <select name="pool_id" id="pool_id" 
                                class="form-control">
                                @if(isset($_GET['plano'])) 
                                <option value="{{ $plano->pool->id }}">
                                    {{ $plano->pool->nome }}</option>
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="d-block">Adicionar HotSpot</label>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-success ">
                                            <input type="radio" class="add_hotspot" 
                                            name="hotspot" id="option1" value="1" 
                                            {{ (old('hotspot') == '1' || $plano->hotspot == '1') ? 'checked':'' }}
                                            autocomplete="off" > Sim
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" class="add_hotspot" 
                                            name="add_hotspot" id="option2"
                                            {{ (old('hotspot') == '0' || $plano->hotspot == '0') ? 'checked':'' }} 
                                            value="0" autocomplete="off"> Não
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="d-block">Adicionar PPPoE</label>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-success ">
                                            <input type="radio" class="add_pppoe" name="pppoe" 
                                            {{ (old('pppoe') == '1' || $plano->pppoe == '1') ? 'checked':'' }} 
                                            id="option1" value="1" autocomplete="off" > Sim
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" class="add_pppoe" 
                                            {{ (old('pppoe') == '0' || $plano->pppoe == '0') ? 'checked':'' }} 
                                            name="pppoe" id="option2" value="0" autocomplete="off"> Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <hr>
                    @if(isset($_GET['plano']))
                    <button type="submit" id="save" 
                    class="btn form-control btn-info text-white">Actualizar Plano</button>
                    @else
                    <button type="submit" id="save" 
                    class="btn form-control btn-primary">Cadastrar Plano</button>
                    @endif
                </div>
                
                <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->


            @if(Session::has('success'))
                <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
            @elseif(Session::has('warning'))
                <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
            @endif

            @if(count($planos))
            <table class="table table-responsive table-striped border">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Preço</td>
                        <td>DownLoad</td>
                        <td>UpLoad</td>

                        <td>Servidor Microtik</td>
                        <td>Ip Pool</td>
                        <td>HotSpot</td>

                        <td>PPPoE</td>

                        <td>Por</td>
                        <td>Acções</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($planos as $plano)
                    <tr>
                        <td>
                            {{ $plano->nome }}
                        </td>
                        <td>
                            {{ $plano->preco }}
                        </td>
                        <td>
                            {{ $plano->download }}
                        </td>
                        <td>
                            {{ $plano->upload }}
                        </td>

                        <td>
                            {{ $plano->server->nome }}
                        </td>
                        <td>
                            {{ $plano->pool->nome }}
                        </td>
                        <td>
                            {{ disponivel($plano->hotspot) }}
                        </td>
                        <td>
                            {{ disponivel($plano->pppoe) }}
                        </td>
                        <td>
                            {{ $plano->user->name }}
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" 
                                data-target="#deleteModal{{ $plano->id }}">Excluir</a>
                            <a href="/admin/planos?plano={{ $plano->id }}">Editar</a>

                            <div class="modal fade" id="deleteModal{{ $plano->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" 
                                    id="exampleModalLongTitle">Excluir Equipamento</h5>
                                    
                                </div>
                                <div class="modal-body">
                                    Tens a certeza que desejas deletar o plano {{ $plano->nome }}??
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/plano/delete/{{$plano->id}}" class="btn btn-danger"> <i class="fa fa-trash"></i> Excluir</a>
                                </div>
                                </div>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $planos->links() }}
            @else
            <hr>
            <h4>Sem Planos de Momento.</h4>
            @endif

        </div>
    </div>
</div>

<script>
    $(function() {
        //$('#example').append("Texto para aquele div");
        $('#servidor_id').change(function(e) {
            console.log(e);
            const servidor_id = e.target.value;
            // ajax
            $.get('/admin/pool?servidor_id=' + servidor_id, function(data){
            //console.log(data);
            $('#pool_id').empty();
            $.each(data, function(index, poolObj) {
                $('#pool_id').append('<option value="'+poolObj.id+'">'+poolObj.nome+'</option>');
            });
            });
        })
    })
    
</script>

@endsection
