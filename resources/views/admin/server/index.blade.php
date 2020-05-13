@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Servidores')

@section('content')
<div class="container bg-white px-4 py-4 border">
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between" style="align-items: center">
                <h5 style="text-transform: uppercase">Lista de Servidores: (Total {{ count($servers) }})</h5>    
                <?php 
                if(isset($_GET['query'])) {
                    $query = addslashes($_GET['query']);                    
                }                           
                ?>
                <form action="/admin/servers" method="get">
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
                @if(isset($_GET['server']))
                <h3 class="text-danger  text-uppercase">Atualizar Servidor: {{ $server->nome }} </h3>
                @else
                <h3 class="text-dark text-uppercase">Cadastrar Servidor </h3>
                @endif
                <hr>
            </div>
            @if(isset($_GET['server']))
            <form action="/admin/server/update/{{$server->id}}" autocomplete="off" method="post">
            @else
            <form action="/admin/server/store" autocomplete="off" method="post">
            @endif
            
                @csrf
                <div class="box-body">
                    <div class="row">
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nome">Nome do Servidor</label>
                                <input type="text" class="form-control"
                                value="{{ old('nome') ?? $server->nome }}"
                                id="nome" name="nome" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ip">IP Do Servidor</label>
                                <input type="text" class="form-control" 
                                value="{{ old('ip') ?? $server->ip }}"
                                id="ip" name="ip" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="porta">PORTA</label>
                                <input type="text" class="form-control" 
                                value="{{ old('porta') ?? $server->porta }}"
                                id="porta" name="porta" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" 
                                value="{{ old('login') ?? $server->login }}"
                                id="login" name="login" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="text" class="form-control"
                                value="{{ old('senha') ?? $server->senha }}" 
                                id="senha" name="senha" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="interface">Interface</label>
                                <input type="text" class="form-control" 
                                value="{{ old('interface') ?? $server->interface }}"
                                id="interface" name="interface" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="interface">Enviar</label>

                                @if(isset($_GET['server']))
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

            @if(count($servers))
            <table class="table table-responsive table-striped border">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>IP</td>
                        <td>Porta</td>

                        <td>Login</td>
                        <td>Senha</td>
                        <td>Interface</td>

                        <td>Por</td>
                        <td>Acções</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($servers as $server)
                    <tr>
                        <td>
                            {{ $server->nome }}
                        </td>
                        <td>
                            {{ $server->ip }}
                        </td>
                        <td>
                            {{ $server->porta }}
                        </td>
                        <td>
                            {{ $server->login }}
                        </td>
                        <td>
                            {{ $server->senha }}
                        </td>
                        <td>
                            {{ $server->interface }}
                        </td>
                        <td>
                            {{ $server->user->name }}
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" 
                                data-target="#deleteModal{{ $server->id }}">Excluir</a>
                            <a href="/admin/servers?server={{ $server->id }}">Editar</a>

                            <div class="modal fade" id="deleteModal{{ $server->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" 
                                    id="exampleModalLongTitle">Excluir Servidor</h5>
                                    
                                </div>
                                <div class="modal-body">
                                    Tens a certeza que desejas deletar o servidor {{ $server->nome }}??
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/server/delete/{{$server->id}}" class="btn btn-danger"> <i class="fa fa-trash"></i> Excluir</a>
                                </div>
                                </div>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $servers->links() }}
            @else
            <hr>
            <h4>Sem Servidores de Momento.</h4>
            @endif

        </div>
    </div>
</div>
@endsection
