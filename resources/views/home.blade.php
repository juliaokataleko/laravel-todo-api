@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - Página Inicial')

@section('content')
<div class="container mt-4" id="app">
    @if(Auth::user()->role <= 2)
    <h3>Página Inicial</h3>
    @else
    <div class="row">
        

        <!-- Lista de Carnês de um clinte -->
        <div class="col-md-12" >
            <div class="card border">
                <div class="card-header">
                    Meus Carnês
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto">
                    <ul class="list-group">
                        @if(count($meusCarnes) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Vencimento</td>
                                    <td>Valor</td>
                                    <td>Data de Criação</td>
                                    <td>Estado</td>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($meusCarnes as $carne)
                            <tr>
                                <td>
                                    {{ $carne->id }}
                                </td>
                                <td>
                                    {{ dateFormat($carne->vencimento) }}
                                </td>
                                <td>
                                    {{ currencyFormat($carne->valor) }}
                                </td>
                                <td>
                                    {{ dateFormat($carne->created_at) }}
                                </td>
                                <td>
                                    {{ statusCarne($carne->status) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Lista de ordens de serviço de um clinte
        <div class="col-md-12 mt-4">
            <div class="card border">
                <div class="card-header">
                    Ordens de Serviço
                </div>
                <div class="card-body">
                    Minhas Ordens de serviço Aqui
                </div>
            </div>
        </div> -->

    </div>
    @endif
</div>


@endsection


