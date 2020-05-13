@extends('layouts.admin')

@section('title', ' Painel de Controle - ' . config('app.name', 'Laravel'))

@section('content')

<style>
    .col-md-4 i, .col-md-12 i {
        font-size: 40px;
        color: #0a528d;
    }
</style>

<div class="container bg-white px-4 py-4 border">

    <h2>PAINEL DE CONTROLE</h2>

    <a href="/admin/config">Configurações</a>

    <div class="row p-3">

        <div class="col-md-12 mb-3" style="padding: 0; margin: 0;">
            <div class="card border" >
                <div class="card-header">
                    Assinaturas Com Carnês A Esgotar
                </div>
                <div class="card-body" style="max-height: 200px; overflow-y: auto">
                    @if(count($assinaturasCarnes) > 0)
                        <ul class="list-group">
                        @foreach ($assinaturasCarnes as $ass)
                            @if(count($ass->carnes) < 3)

                                <li class="list-group-item">
                                    {{ $ass->user->name }} <br>
                                    <span class="text-danger">
                                        {{ count($ass->carnes) }} Carnês | 
                                        <a 
                                        href="{{ BASE_URL }}/admin/carne/create?user={{ $ass->user->id }}">
                                        Gerar Mais</a> 
                                    </span> 
                                </li>

                            @endif
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 my-3">
            <div class="row border p-2 text-white">
                <div class="col-md-4 text-center bg-orange" 
                style="
                background: #456444;
                min-height: 200px; display: flex; 
                flex-direction: column; 
                justify-content: center; align-items: center">
                    <h2>ASSINATURAS VENCIDAS</h2>
                    <p> {{ count($vencidas) }} </p>
                </div>

                <div class="col-md-4 text-center bg-success" 
                style="min-height: 200px; display: flex; 
                flex-direction: column; 
                justify-content: center; align-items: center">
                    <h2>ASSINATURAS ATIVAS</h2>
                    <p> {{ count($ativas) }} </p>
                </div>

                <div class="col-md-4 text-center bg-danger" 
                style="min-height: 200px; display: flex; 
                flex-direction: column; 
                justify-content: center; 
                align-items: center">
                    <h2>ASSINATURAS BLOQUEADAS</h2>
                    <p> {{ count($bloqueadas) }} </p>
                </div>
            </div>
            
        </div>
        

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-user-friends"></i>
            <hr>
            Clientes: {{ count($customers) }} <br>
            <a href="/admin/create-customer">Adicionar cliente</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-user-friends"></i>
            <hr>
            Assinaturas: {{ count($assinaturas) }} <br>
            <a href="/admin/assinaturas">Ver Assinaturas</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-list-alt"></i>
            <hr>
            Funcionários: {{ count($employers) }} <br>
            <a href="/admin/employer/create">Adicionar funionário</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-desktop"></i>
            <hr>
            Servidores: {{ count($servers) }} <br>
            <a href="/admin/servers">Novo Servidor</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-desktop"></i>
            <hr>
            Servidores Ip Pool: {{ count($pools) }} <br>
            <a href="/admin/pools">Ip Pool</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-desktop"></i>
            <hr>
            Equipamentos: {{ count($equipamentos) }} <br>
            <a href="/admin/equipamentos">Ver Equipamentos</a>
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-list"></i>
            <hr>
            Planos: {{ count($planos) }} <br>
            <a href="/admin/planos">Ver Planos</a>
        </div>
        
        <div class="col-md-4 py-4 text-center border">
            <i class="fab fa-product-hunt"></i>
            <hr>
            Estados: {{ count($states) }}
        </div>
    

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-list"></i>
            <hr>
            Cidades: {{ count($cities) }}
        </div>
   {{-- 
        
    
        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-star"></i>
            <hr>
            Classificações: {{ count($ratings) }}
        </div>

        <div class="col-md-4 py-4 text-center border">
            <i class="fa fa-shopping-cart"></i>
            <hr>
            Compras: {{ count($purchases) }}
        </div>

        <div class="col-md-12 py-4 text-center border">
            <i class="fa fa-images"></i>
            <hr>
            Ficheiros: {{ count($files) }}
        </div>

        --}}

    </div>

</div>
@endsection
