@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Assinaturas')

@section('content')
<div class="container bg-white px-4 py-4 border">
<h1>Assinaturas De Clientes</h1>
<h2>Total: {{ $assinaturas_total }} </h2>
<a href="/admin/assinatura/create" 
class="btn btn-outline-success mb-4">Nova Assinatura</a>

@if(Session::has('success'))
    <p class="mb-4  alert alert-success">{{ Session::get('success') }}</p>
@elseif(Session::has('warning'))
    <p class="mb-4 alert alert-warning">{{ Session::get('warning') }}</p>
@endif

@if(count($assinaturas) > 0) 
    <table class="table border-left border-right table-striped table-responsive">
        <thead>
            <tr>
                <td>Status</td>
                <td style="width: 300px;">
                    Cliente
                </td>
                <td>
                    Plano
                </td>
                <td>
                    Ip
                </td>
                <td>
                    Mac
                </td>
                <td>
                    Valor
                </td>
                <td>
                    Estado
                </td>
                <td>
                    Cidade
                </td>
                <td>
                    Dias
                </td>
                <td>
                    Acções
                </td>
            </tr>
        </thead>
        <tbody>

        
    @foreach ($assinaturas as $assinatura)
    <tr>
        <td>
            {{ statusAssinatura($assinatura->status, $assinatura->vencimento) }}
        </td>
        <td>
            <a href="#" data-toggle="modal"
            data-target="#assinatura{{$assinatura->id}}">
            {{ $assinatura->user->name }} </a> <br>
            <a href="/admin/assinatura/imprimir/{{ $assinatura->id }}">Imprimir Contrato</a>
        </td>
        <td>
            {{ $assinatura->plano->nome }}
        </td>
        <td>
            {{ $assinatura->ip }}
        </td>
        <td>
            {!! $assinatura->mac ?? '<span class=text-danger>Sem mac</span>' !!}
        </td>
        <td>
            {{ currencyFormat($assinatura->valor) }}
        </td>
        <td>
            {{ $assinatura->state->nome }}
        </td>
        <td>
            {{ $assinatura->city->nome }}
        </td>
        <td>
            {!! diasEmFalta($assinatura->vencimento) !!}
        </td>
        <td>
            <a href="#" data-toggle="modal"
            data-target="#assinatura{{$assinatura->id}}">
            <i class="fa fa-eye"></i></a>

            <a href="{{ BASE_URL }}/admin/assinatura/edit/{{ $assinatura->id }}"><i class="fa fa-edit"></i></a>
            <a class="text-danger"
            data-toggle="modal"
            data-target="#assDelete{{$assinatura->id}}"
            href="#"><i class="fa fa-trash"></i></a> 

                    <div class="modal fade" id="assDelete{{$assinatura->id}}" 
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                        <div class="modal-content">
                        <div class="modal-header btn-dark">
                            <h5 class="modal-title text-warning btn-dark" id="exampleModalLongTitle">Atenção!</h5>
                            
                        </div>
                        <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                            
                                <b>Tem a certeza que deseja esta assinatura: </b> {{ $assinatura->id }} <br>
                                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <a href="/admin/assinatura/delete/{{$assinatura->id}}" class="btn btn-danger">Remover</a>
                        </div>
                        </div>
                    
                    </div>
                    </div>

                    <div class="modal fade" id="assinatura{{$assinatura->id}}" 
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            
                        <div class="modal-content">
                        <div class="modal-header btn-dark">
                            <h5 class="modal-title text-warning btn-dark" 
                            id="exampleModalLongTitle">Detalhes da Assinatura: {{ $assinatura->id }}</h5>
                            
                        </div>
                        <div class="modal-body text-center" style="max-height: 300px; overflow-y: auto;">
                            <?php
                            if(!null == $assinatura->user->avatar && file_exists('uploads/avatar/'.$assinatura->user->avatar)): ?>
                                <img style="width: 130px; height: 130px;
                                border: 6px solid #444; 
                                object-fit: cover; " src="/uploads/avatar/{{ $assinatura->user->avatar }}" 
                                class="rounded " alt="...">
                            <?php else: ?>
                                <img style="width: 130px; height: 130px;;" src="/images/person.png" 
                                class="rounded border" alt="...">
                            <?php endif; ?>
                            <table class="table mt-3 table-striped">
                                <tr>
                                    <td>
                                        <b>Estado: </b> {{ statusAssinatura($assinatura->status, $assinatura->vencimento) }}
                                    </td>
                                    <td>
                                        <b>Cliente: </b> {{ $assinatura->user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Mac: </b> {!! $assinatura->mac ?? '<span class=text-danger>Sem mac</span>' !!}
                                    </td>
                                    <td>
                                        <b>Valor: </b> {{ currencyFormat($assinatura->valor) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Telefone: </b> {{ $assinatura->user->phone }}
                                    </td>
                                    <td>
                                        <b>Celular: </b> {{ $assinatura->user->celular }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Plano: </b> {{ $assinatura->plano->nome }}
                                    </td>
                                    <td>
                                        <b>Ip: </b> {{ $assinatura->ip }}
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <b>Estado: </b> {{ $assinatura->state->nome }}
                                    </td>
                                    <td>
                                        <b>Cidade: </b> {{ $assinatura->city->nome }} <br>
                                        <b>Bairro: </b> {{ $assinatura->user->bairro }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Complemento: </b> {{ $assinatura->complemento }}
                                    </td>
                                    <td>
                                        <b>Referência: </b> {{ $assinatura->referencia }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Número: </b> {{ $assinatura->numero }}
                                    </td>
                                    <td>
                                        <b>CEP: </b> {{ $assinatura->cep }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Acréscimo: </b> {{ currencyFormat($assinatura->acrescimo) }}
                                    </td>
                                    <td>
                                        <b>Desconto: </b> {{ currencyFormat($assinatura->desconto) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Taxa de Instalação: </b> <br> {{ ($assinatura->taxa_instalacao) ? currencyFormat($assinatura->taxa_instalacao) : 'Sem taxa' }}
                                    </td>
                                    <td>
                                        <b>A Pagar: </b> {{ currencyFormat($assinatura->valor) }}
                                    </td>
                                </tr>
                                @if(count($assinatura->equipamentos) > 0)
                                <tr>
                                    <td colspan="2">
                                        
                                            <table class="table table-bordered table-striped" id="equipamentosLst">
                                                <thead>
                                                    <tr>
                                                        <th>Equipamento</th>
                                                        <th>Quantidade</th>
                                                        <th>Observações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($assinatura->equipamentos as $equipamento)
                                                        <tr>
                                                            <td>{{ $equipamento->equipamento->equipamento }}</td>
                                                            <td>{{ $equipamento->quantidade }}</td>
                                                            <td>{{ $equipamento->observacoes }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>
                                        <b class="text-success">Vencimento: </b> {{ dateFormat($assinatura->vencimento) }}
                                    </td>
                                    <td>
                                        <b>Dias Restantes: </b> {!! diasEmFalta($assinatura->vencimento) !!}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <div><b class="text-success">Vencimento: 
                                </b> {{ dateFormat($assinatura->vencimento) }}</div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <a href="/admin/assinatura/update/{{$assinatura->id}}" 
                                class="btn btn-success">Atualizar</a>
                        </div>
                        </div>
                    
                    </div>
                    </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{{ $assinaturas->links() }}
@endif

</div>
@endsection
