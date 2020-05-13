@extends('layouts.admin')

@section('title', ' Painel de Controle - ' . config('app.name', 'Laravel'))

@section('content')

<style>
    .col-md-4 i, .col-md-12 i {
        font-size: 40px;
        color: #e67e22
    }
</style>

<div class="container bg-white px-4 py-4 border">

    <div class="d-flex justify-content-between" style="align-items: center">
        <h5 style="text-transform: uppercase">Lista de Clientes: 
            (Total {{ count($customers) }})</h5>    
        <?php 
        if(isset($_GET['query'])) {
            $query = addslashes($_GET['query']);                    
        }                           
        ?>
        <form action="/admin/customers" method="get">
            <div class="input-group mb-3">
            <input type="search" 
            class="form-control" 
            name="query"
            value="{{ (isset($query)) ? $query : '' }}"
            placeholder="Pesquisar Clientes">
            <div class="input-group-append">
                <button class="btn btn-secondary" 
                type="submit"> <i class="fa fa-search"></i> </button>
            </div>
            </div>
        </form>          
    </div>  

<a href="/admin/create-customer">Adicionar cliente</a><br><br>

@if(Session::has('success'))
    <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
@elseif(Session::has('warning'))
    <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
@endif

@if(count($customers) > 0)
<table class="table table-striped border">
    <thead>
        <tr>
            <td>Nome</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Cidade</td>
            <td>Status</td>
            <td style="width: 120px">Acções</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{$customer->user->name}}</td>
                <td>{{$customer->user->email}}</td>
                <td>{{$customer->user->phone}}</td>
                <td>{{$customer->user->city->nome}}</td>
                <td>{{ status($customer->status) }}</td>
                <td> 
                    <a href="/admin/edit-customer/{{$customer->user->id}}"><i class="fa fa-edit"></i></a> 
                    <a
                    data-toggle="modal"
                    data-target="#userModal{{$customer->user->id}}"
                    href="#"><i class="fa fa-eye"></i></a> 

                    <a class="text-danger"
                    data-toggle="modal"
                    data-target="#userModalDelete{{$customer->user->id}}"
                    href="#"><i class="fa fa-trash"></i></a> 

                    <div class="modal fade" id="userModalDelete{{$customer->user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                            <div class="modal-content">
                            <div class="modal-header btn-dark">
                                <h5 class="modal-title text-warning btn-dark" id="exampleModalLongTitle">Atenção!</h5>
                               
                            </div>
                            <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                                
                                    <b>Tem a certeza que deseja remover: </b> {{$customer->user->name}} <br>
                                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="/admin/customer/delete/{{$customer->user->id}}" class="btn btn-danger">Remover</a>
                            </div>
                            </div>
                        
                        </div>
                        </div>


                    <div class="modal fade" id="userModal{{$customer->user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-warning">
                                <h5 class="" id="exampleModalLongTitle">
                                    <?php
                                    if(!null == $customer->user->avatar && file_exists('uploads/avatar/'.$customer->user->avatar)): ?>
                                        <img style="width: 70px; height: 70px;
                                        border: 6px solid #444; 
                                        object-fit: cover; " src="/uploads/avatar/{{ $customer->user->avatar }}" 
                                        class="rounded " alt="...">
                                    <?php else: ?>
                                        <img style="width: 70px; height: 70px;;" src="/images/person.png" 
                                        class="rounded border" alt="...">
                                    <?php endif; ?>
                                    Dados: {{$customer->user->name}}</h5>
                               
                            </div>
                            <div class="modal-body bg-light" style="max-height: 300px; overflow-y: auto;">
                                
                                    <b>Nome: </b> {{$customer->user->name}} <br>
                                    <b>Email: </b> {{$customer->user->email}} <br>
                                    <b>Telefone: </b> {{$customer->user->phone}} <br>
                                    <b>Celular: </b> {{$customer->user->celular}} <hr>
                                    <b>Estado: </b> {{$customer->user->state->nome}} <br>
                                    <b>Cidade: </b> {{$customer->user->city->nome}} <br>
                                    <b>Bairro: </b> {{$customer->user->bairro}} <br>
                                    <b>Referência: </b> {{$customer->referencia }} <br>
                                    <b>Complemento: </b> {{ $customer->complemento }} <br>
                                    <b>Número: </b> {{ $customer->numero }} <br>
                                    <b>CEP: </b> {{ $customer->cep }} <br>
                                    <b>CPF: </b> {{ $customer->cpf }} <br>
                                    <b>RG: </b> {{ $customer->rg }} <br>
                                    <hr>
                                    <b>Usuário: </b> {{$customer->user->username}} <br>
                                    <b>Aniversário: </b> {{ dateFormat($customer->user->birth_day) }} <br>
                                    <b>Gênero: </b> {{ gender($customer->user->gender) }} <br>
                                    <b>Pai: </b> {{$customer->user->pai}} <br>
                                    <b>Mãe: </b> {{$customer->user->mae}} <br>
                                    <b>Estado Civil: </b> {{ $customer->user->civil }} <hr>
                                    <b>Vencimento Do Contrato: </b> {{ dateFormat($customer->vencimento_contrato) }} <br>
                                    <p class="border p-2">
                                        {{ $customer->observacoes }}
                                    </p>
                            </div>
                            <div class="modal-footer bg-dark">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="/admin/edit-customer/{{$customer->user->id}}" class="btn btn-primary">Actualizar</a>
                            </div>
                            </div>
                        
                        </div>
                        </div>





                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $customers->links() }}

@else
<hr>
<h4>Sem Clientes de Momento.</h4>
@endif

</div>
@endsection