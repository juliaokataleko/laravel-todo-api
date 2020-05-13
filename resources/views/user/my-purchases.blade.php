@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - Meus Pedidos de Compra')

@section('content')
<div class="container mt-4 p-4 bg-white border">
    
   <h4>Meus Pedidos Compra</h4>
    <hr>
   @if(count($myPurchases) > 0)

   <table class="table table-responsive table-striped">
       <thead>
           <tr>
               <td>ID PEDIDO</td>
               <td>Usuário</td>
               <td>Valor Total</td>
               <td>Desconto</td>
               <td>A Pagar</td>
               <td>Data</td>
               <td>Estado</td>
           </tr>
       </thead>
       <tbody>
           @foreach ($myPurchases as $purchase)
               <tr>
                   <td>{{ $purchase->id }}</td>
                   <td>{{ $purchase->user->name }}</td>
                   <td>{{ currencyFormat($purchase->total).' Akz' }}</td>
                   <td>{{ currencyFormat($purchase->discount).' Akz' }}</td>
                   <td>{{ currencyFormat($purchase->to_pay).' Akz' }}</td>
                   <td>{{ dateFormat($purchase->created_at) }}</td>
                   <td> 
                       {!! ($purchase->status == 0) ? 
                        '<span class="text-danger">Pendente</span>' : '<span class="text-success">Finalizado</span>' 
                    !!}

                    <br>
                             <a href="#"  data-toggle="modal" 
                             data-target="#produtos{{ $purchase->id }}">
                             Ver Produtos</a>

                             <!-- Modal -->
                            <div class="modal fade" 
                            id="produtos{{ $purchase->id }}" tabindex="-1" 
                                role="dialog" aria-labelledby="exampleModalCenterTitle" 
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="">
                                    ID: {{ $purchase->id }} <br>
                                    Total: {{ currencyFormat($purchase->to_pay) }} Akz
                                    </h5>
                                    <button type="button" class="close" 
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="max-height: 180px; overflow-y: auto;">
                                    <ul class="list-group">
                                    @foreach ($purchase->items as $item)
                                    <li class="list-group-item">
                                        {{ $item->product->name }} <br>
                                        <b>Quantidade</b> {{ $item->quantity }} <br>
                                        <b>Desconto</b> {{currencyFormat($item->discount) }} Akz <br>
                                        <b>Preço</b> {{currencyFormat($item->price) }} Akz <br>
                                        <b>A Pagar</b> {{currencyFormat($item->total) }} Akz
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" 
                                    data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary">Imprimir</button>
                                </div>
                                </div>
                            </div>
                            </div>
                </td>
                   
               </tr>
           @endforeach
       </tbody>
   </table>

   {{ $myPurchases->links() }}

   @else 

   <h3>Ainda Não fizeste nenhum pedido</h3>
   <a href="/">Acesse nossa lista de Produtos</a>

    @endif
</div>
@endsection
