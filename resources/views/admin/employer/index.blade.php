@extends('layouts.admin')

@section('title', 'Cadastrar Funcionário - ' . config('app.name', 'Laravel'))

@section('content')

<div class="container bg-white px-4 py-4 border">

    <div class="d-flex justify-content-between" style="align-items: center">
        <h5 style="text-transform: uppercase">Lista de Funcionários: 
            (Total {{ count($employers) }})</h5>    
        <?php 
        if(isset($_GET['query'])) {
            $query = addslashes($_GET['query']);                    
        }                           
        ?>
        <form action="/admin/employers" method="get">
            <div class="input-group mb-3">
            <input type="search" 
            class="form-control" 
            name="query"
            value="{{ (isset($query)) ? $query : '' }}"
            placeholder="Pesquisar Funcionários">
            <div class="input-group-append">
                <button class="btn btn-secondary" 
                type="submit"> <i class="fa fa-search"></i> </button>
            </div>
            </div>
        </form>          
    </div>  

<a href="/admin/employer/create">Cadastrar Funcionário</a><br><br>

@if(Session::has('success'))
    <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
@elseif(Session::has('warning'))
    <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
@endif

@if(count($employers) > 0)
<table class="table table-striped border">
    <thead>
        <tr>
            <td>Nome</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Cidade</td>
            <td style="width: 120px">Acções</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($employers as $employer)
            <tr>
                <td>{{$employer->name}}</td>
                <td>{{$employer->email}}</td>
                <td>{{$employer->phone}}</td>
                <td>{{$employer->city->nome}}</td>
                <td> 
                    <a href="/admin/employer/edit/{{$employer->id}}"><i class="fa fa-edit"></i></a> 
                    <a
                    data-toggle="modal"
                    data-target="#userModal{{$employer->id}}"
                    href="#"><i class="fa fa-eye"></i></a> 

                    <a class="text-danger"
                    data-toggle="modal"
                    data-target="#userModalDelete{{$employer->id}}"
                    href="#"><i class="fa fa-trash"></i></a> 

                    <div class="modal fade" id="userModalDelete{{$employer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                            <div class="modal-content">
                            <div class="modal-header btn-dark">
                                <h5 class="modal-title text-warning btn-dark" id="exampleModalLongTitle">Atenção!</h5>
                               
                            </div>
                            <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                                
                                    <b>Tem a certeza que deseja remover: </b> {{$employer->name}} <br>
                                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="/admin/employer/delete/{{$employer->id}}" class="btn btn-danger">Remover</a>
                            </div>
                            </div>
                        
                        </div>
                        </div>


                    <div class="modal fade" id="userModal{{$employer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                            <div class="modal-content ">
                            <div class="modal-header bg-dark text-warning">
                                <h5 class="" id="exampleModalLongTitle">
                                    <?php
                                    if(!null == $employer->avatar && file_exists('uploads/avatar/'.$employer->avatar)): ?>
                                        <img style="width: 70px; height: 70px;
                                        border: 6px solid #444; 
                                        object-fit: cover; " src="/uploads/avatar/{{ $employer->avatar }}" 
                                        class="rounded" alt="...">
                                    <?php else: ?>
                                        <img style="width: 70px; height: 70px;;" src="/images/person.png" 
                                        class="rounded border" alt="...">
                                    <?php endif; ?> 
                                    Dados: {{$employer->name}}
                                </h5>
                               
                            </div>
                            <div class="modal-body  bg-light" style="max-height: 300px; overflow-y: auto;">
                                
                                    <b>Nome: </b> {{$employer->name}} <br>
                                    <b>Email: </b> {{$employer->email}} <br>
                                    <b>Telefone: </b> {{$employer->phone}} <br>
                                    <b>Celular: </b> {{$employer->celular}} <hr>
                                    <b>Estado: </b> {{$employer->state->nome}} <br>
                                    <b>Cidade: </b> {{$employer->city->nome}} <br>
                                    <b>Bairro: </b> {{$employer->bairro}} <br>
                                   
                                    <hr>
                                    <b>Usuário: </b> {{$employer->username}} <br>
                                    <b>Aniversário: </b> {{ dateFormat($employer->birth_day) }} <br>
                                    <b>Gênero: </b> {{ gender($employer->gender) }} <br>
                                    <b>Pai: </b> {{$employer->pai}} <br>
                                    <b>Mãe: </b> {{$employer->mae}} <br>
                                    <b>Estado Civil: </b> {{ $employer->civil }}
                                   
                            </div>
                            <div class="modal-footer bg-dark">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="/admin/employer/edit/{{$employer->id}}" class="btn btn-primary">Actualizar</a>
                            </div>
                            </div>
                        
                        </div>
                        </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $employers->links() }}
@else
<hr>
<h3>Nenhum Funcionário Cadastrado</h3>
@endif

</div>
@endsection