@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Equipamentos')

@section('content')
<div class="container bg-white px-4 py-4 border">
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between" style="align-items: center">
                <h5 style="text-transform: uppercase">Lista de Equipamentos: (Total {{ count($equipamentos) }})</h5>    
                <?php 
                if(isset($_GET['query'])) {
                    $query = addslashes($_GET['query']);                    
                }                           
                ?>
                <form action="/admin/equipamentos" method="get">
                    <div class="input-group mb-3">
                    <input type="search" 
                    class="form-control" 
                    name="query"
                    value="{{ (isset($query)) ? $query : '' }}"
                    placeholder="Pesquisar Equipamento">
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
            
            @if(isset($_GET['equipamento']))
            <form action="/admin/equipamento/update/{{$equipamento->id}}" autocomplete="off" method="post">
            @else
            <form action="/admin/equipamento/store" autocomplete="off" method="post">
            @endif
            
                @csrf
                
                <div>
                    <div class="box-header border-0">
                        @if(isset($_GET['equipamento']))
                        <h3 class="text-danger  text-uppercase">Atualizar Equipamento: {{ $equipamento->equipamento }} </h3>
                        @else
                        <h3 class="text-dark text-uppercase">Cadastrar Equipamento </h3>
                        @endif
                        <hr>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   <div class="box-body">
                            <div class="row">
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="equipamento">Equipamento</label>
                                        <input type="text" class="form-control" 
                                        value="{{ old('equipamento') ?? $equipamento->equipamento }}"
                                        id="equipamento" name="equipamento" required>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nota_fiscal">Nota Fiscal</label>
                                        <input type="text" class="form-control" 
                                        value="{{ old('nota_fiscal') ?? $equipamento->nota_fiscal }}"
                                        id="nota_fiscal" name="nota_fiscal" >
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="serie">Nº de Série</label>
                                        <input type="text" class="form-control" 
                                        value="{{ old('numero_serie') ?? $equipamento->numero_serie }}"
                                        id="numero_serie" name="numero_serie" >
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="preco_custo">Preço de Custo</label>
                                        <input type="text" class="form-control" 
                                        value="{{ old('preco_custo') ?? $equipamento->preco_custo }}"
                                        id="preco_custo" name="preco_custo">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade">Quantidade</label>
                                        <input type="number" class="form-control" 
                                        value="{{ old('quantidade') ?? $equipamento->quantidade }}"
                                        id="quantidade" name="quantidade">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" class="form-control" 
                                        value="{{ old('modelo') ?? $equipamento->modelo }}"
                                        id="modelo" name="modelo">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fabricante">Fabricante</label>
                                        <input type='text' class="form-control" 
                                        value="{{ old('fabricante') ?? $equipamento->fabricante }}"
                                        name='fabricante' id="fabricante">
        
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="aquisicao">Aquisição</label>
                                        <input type='date' class="form-control" 
                                        value="{{ old('aquisicao') ?? $equipamento->aquisicao }}"
                                        name='aquisicao' id="aquisicao">
        
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="etiqueta">Etiqueta</label>
                                        <input type='text' class="form-control" 
                                        value="{{ old('etiqueta') ?? $equipamento->etiqueta }}"
                                        name='etiqueta' id="etiqueta">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="garantia">Garatia</label>
                                        <select name="garantia" class="form-control" id="garantia" class="garantia">
                                            <option value="0" selected>Selecione</option>
                                            <option value="1" {{ (old('garantia') == 1 || $equipamento->garantia == 1) ? 'selected':'' }}>3 meses</option>
                                            <option value="2" {{ (old('garantia') == 2 || $equipamento->garantia == 2) ? 'selected':'' }}>6 meses</option>
                                            <option value="3" {{ (old('garantia') == 3 || $equipamento->garantia == 3) ? 'selected':'' }}>12 meses</option>
                                            <option value="4" {{ (old('garantia') == 4 || $equipamento->garantia == 4) ? 'selected':'' }}>18 meses</option>
                                            <option value="5" {{ (old('garantia') == 5 || $equipamento->garantia == 5) ? 'selected':'' }}>24 meses</option>
                                            <option value="6" {{ (old('garantia') == 6 || $equipamento->garantia == 6) ? 'selected':'' }}>30 meses</option>
                                            <option value="7" {{ (old('garantia') == 7 || $equipamento->garantia == 7) ? 'selected':'' }}>36 meses</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <label for="">Disponibilidade</label>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-success active">
                                            <input type="radio" name="disponibilidade" id="option1" value="1" 
                                            {{ (old('disponibilidade') == '1' || $equipamento->disponibilidade == '1') ? 'checked':'' }}
                                            autocomplete="off"> Disponível
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" name="disponibilidade" id="option2" 
                                            {{ (old('disponibilidade') == '0' || $equipamento->disponibilidade == '0') ? 'checked':'' }}
                                            value="0" autocomplete="off"> Indisponível
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Concluir</label>
                                    @if(isset($_GET['equipamento']))
                                    <button type="submit" id="save" 
                                    class="btn form-control btn-info text-white">Actualizar Equipamento</button>
                                    @else
                                    <button type="submit" id="save" 
                                    class="btn form-control btn-primary">Cadastrar Equipamento</button>
                                    @endif
                                </div>
        
                            </div>
        
                        </div>
                        <!-- /.box-body -->
        
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

            @if(count($equipamentos))
            <table class="table table-responsive table-striped border">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Disponível</td>
                        <td>Fiscal</td>
                        <td>Série</td>

                        <td>Custo</td>
                        <td>Quatidade</td>
                        <td>Modelo</td>

                        <td>Fabricante</td>

                        <td>Aquisição</td>
                        <td>Etiqueta</td>
                        <td>Garantia</td>
                        <td>Acções</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($equipamentos as $equipamento)
                    <tr>
                        <td>
                            {{ $equipamento->equipamento }}
                        </td>
                        <td>
                            {{ disponivel($equipamento->disponibilidade) }}
                        </td>
                        <td>
                            {{ $equipamento->nota_fiscal }}
                        </td>
                        <td>
                            {{ $equipamento->numero_serie }}
                        </td>

                        <td>
                            {{ currencyFormat($equipamento->preco_custo) }}
                        </td>
                        <td>
                            {{ $equipamento->quantidade }}
                        </td>
                        <td>
                            {{ $equipamento->modelo }}
                        </td>
                        <td>
                            {{ $equipamento->fabricante }}
                        </td>
                        <td>
                            {{ $equipamento->aquisicao }}
                        </td>
                        <td>
                            {{ $equipamento->etiqueta }}
                        </td>
                        <td>
                            {{ garantia($equipamento->garantia) }}
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" class="text-danger" 
                                data-target="#deleteModal{{ $equipamento->id }}"><i class="fa fa-trash"></i></a>
                            <a href="/admin/equipamentos?equipamento={{ $equipamento->id }}"><i class="fa fa-edit"></i></a>

                            <div class="modal fade" id="deleteModal{{ $equipamento->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" 
                                    id="exampleModalLongTitle">Excluir Equipamento</h5>
                                    
                                </div>
                                <div class="modal-body">
                                    Tens a certeza que desejas deletar o equipamento {{ $equipamento->equipamento }}??
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/equipamento/delete/{{$equipamento->id}}" class="btn btn-danger"> <i class="fa fa-trash"></i> Excluir</a>
                                </div>
                                </div>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $equipamentos->links() }}
            @else
            <hr>
            <h4>Sem Equipamentos de Momento.</h4>
            @endif

        </div>
    </div>
</div>
@endsection
