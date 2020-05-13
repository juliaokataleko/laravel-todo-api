@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Servidores')

@section('content')
<div class="container bg-white px-4 py-4 border">
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between" style="align-items: center">
                <h5 style="text-transform: uppercase">Lista de Ip Pool: (Total {{ count($pools) }})</h5>    
                <?php 
                if(isset($_GET['query'])) {
                    $query = addslashes($_GET['query']);                    
                }                           
                ?>
                <form action="/admin/pools" method="get">
                    <div class="input-group mb-3">
                    <input type="search" 
                    class="form-control" 
                    name="query"
                    value="{{ (isset($query)) ? $query : '' }}"
                    placeholder="Pesquisar Servidor">
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
                @if(isset($_GET['pool']))
                <h3 class="text-danger  text-uppercase">Atualizar IP Pool: {{ $pool->nome }} </h3>
                @else
                <h3 class="text-dark text-uppercase">Cadastrar Ip Pool </h3>
                @endif
                <hr>
            </div>
            @if(isset($_GET['pool']))
            <form action="/admin/pool/update/{{$pool->id}}" autocomplete="off" method="post">
            @else
            <form action="/admin/pool/store" autocomplete="off" method="post">
            @endif
            
                @csrf
                <div class="box-body">
                    <div class="row">
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome do Pool</label>
                                <input type="text" class="form-control"
                                value="{{ old('nome') ?? $pool->nome }}"
                                id="nome" name="nome" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ip">IP Do Servidor</label>
                                <input type="text" class="form-control" 
                                value="{{ old('ip') ?? $pool->ip }}"
                                id="ip" name="ip" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="">Servidor</label>
                            <select name="servidor_id" class="form-control" id="servidor_id">
                                @if(!isset($_GET['pool'])) 
                                <option value="" selected>Selecionar servidor

                                </option>
                                @else
                                <option value="{{ $pool->server->id }}" selected>{{ $pool->server->nome }}

                                </option>
                                @endif
                                @foreach ($servers as $server)
                                    <option value="{{ $server->id }}">{{ $server->nome }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="interface">Enviar</label>

                                @if(isset($_GET['pool']))
                                <button type="submit" id="save" 
                                class="btn form-control btn-info text-white">Actualizar Servidor</button>
                                @else
                                <button type="submit" id="save" 
                                class="btn form-control btn-success">Cadastrar Servidor</button>
                                @endif
                                
                            </div>
                        </div>

                    </div>

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

            @if(count($pools))
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>IP</td>
                        <td>Servidor</td>

                        <td>Por</td>
                        <td>Acções</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($pools as $pool)
                    <tr>
                        <td>
                            {{ $pool->nome }}
                        </td>
                        <td>
                            {{ $pool->ip }}
                        </td>
                        <td>
                            {{ $pool->server->nome }}
                        </td>
                        <td>
                            {{ $pool->user->name }}
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" 
                                data-target="#deleteModal{{ $pool->id }}">Excluir</a>
                            <a href="/admin/pools?pool={{ $pool->id }}">Editar</a>

                            <div class="modal fade" id="deleteModal{{ $pool->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" 
                                    id="exampleModalLongTitle">Excluir Servidor</h5>
                                    
                                </div>
                                <div class="modal-body">
                                    Tens a certeza que desejas deletar o Ip Pool {{ $pool->nome }}??
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/pool/delete/{{$pool->id}}" class="btn btn-danger"> <i class="fa fa-trash"></i> Excluir</a>
                                </div>
                                </div>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $pools->links() }}
            @else
            <hr>
            <h4>Sem Ip Pool de Momento.</h4>
            @endif

        </div>
    </div>
</div>
@endsection
