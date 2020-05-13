@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Editar Assinatura')

@section('content')
<div class="container bg-white px-4 py-4 border">

<div class="">
    <!-- general form elements -->
    <div>
        <div class="box-header border-0">
            <h3>Editar Assinatura: {{ $assinatura->id }} </h3>
            <hr>
        </div>
        <!-- form start -->
        <form role="form" autocomplete="off" enctype="multipart/form-data" method="POST" action="scripts/employerAdd.php">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_id"><small class="text-danger">*</small> Cliente</label>
                            <select class="form-control cliente" onchange="clienteData()" id="cliente" name="cliente">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->user->id }}" {{ ($assinatura->user->id == $cliente->user->id) ? 'selected':'' }}>{{ $cliente->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p class="cep"></p>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="plano"><small class="text-danger">*</small> Plano</label>
                            <select class="form-control action" id="plano" name="plano">
                                <option value="" selected disabled>Selecione</option>
                                @foreach ($planos as $plano)
                                    <option value="{{ $plano->id }}" {{ ($assinatura->plano_id == $plano->id) ? 'selected':'' }}>{{ $plano->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ip">IP</label>
                            <input type='text' 
                            class="form-control" 
                            value="{{ $assinatura->ip }}"
                            name='ip' id="ip">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mac">MAC</label>
                            <input style="text-transform: uppercase;" 
                            type="text" class="form-control" 
                            value="{{ $assinatura->mac }}"
                            id="mac" name="mac">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for=""><small class="text-danger">*</small> Tipo de autenticação</label>

                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-success">
                                    <input type="radio" class="display-b" value="1" 
                                    {{ ($assinatura->tipo_autenticacao == 1) ? 'checked':'' }}
                                    name="tipo_auth" id="hp">
                                    HotSpot
                                </label>

                                <label class="btn btn-success">
                                    <input type="radio" value="2" 
                                    {{ ($assinatura->tipo_autenticacao == 2) ? 'checked':'' }}
                                    name="tipo_auth" id="ppp">
                                    PPPoE
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" class="display-b" 
                                    {{ ($assinatura->tipo_autenticacao == 3) ? 'checked':'' }}
                                    value="3" name="tipo_auth" id="ipa">
                                    IP/ARP</label>
                                <label class="btn btn-success">
                                    <input type="radio" value="4" 
                                    {{ ($assinatura->tipo_autenticacao == 4) ? 'checked':'' }}
                                    name="tipo_auth" id="dhcp">
                                    DHCP</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="login"><small class="text-danger">*</small> Login</label>
                            <input type="text" class="form-control" id="login" 
                            value="{{ $assinatura->login }}"
                            name="login">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><small class="text-danger">*</small> Senha</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->senha }}"
                            id="password" name="password" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-12 ">
                        <hr>
                        <div class="row mb-4">
                            <form action="" id="frmProduct">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="equipamento">Equipamento</label>
                                        <select class="form-control" onchange="equipamentoQty()" id="equipamento" name="equipamento">
                                            <option value="" selected disabled>Selecione</option>
                                            @foreach ($equipamentos as $equipamento)
                                                <option value="{{ $equipamento->id }}">{{ $equipamento->equipamento }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="equipamento_qty" id="equipamento_qty">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qtd_utilizado">QTD UTILIZADO</label>
                                        <input type='number' class="form-control" min="1" max="" name='qtd_utilizado' value="1" id="qtd_utilizado">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="observacoes">Observações</label>
                                        <input type='text' class="form-control" name='observacoes' id="observacoes">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">...</label>
                                    <button type="button" class="btn 
                                    btn-primary mb-3 form-control" id="save" onclick="addEquipamentos()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped" id="equipamentosLst">
                                        <thead>
                                            <tr>
                                                <th>Excluir</th>
                                                <th>Código</th>
                                                <th>Equipamento</th>
                                                <th>Quantidade</th>
                                                <th>Observações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assinatura->equipamentos as $equipamento)
                                                <tr>
                                                    <td><button name='record' onclick='deleterow(this)' class='btn btn-warning btn-xs'>Remover</button></td>
                                                    <td> {{ $equipamento->equipamento->id }} </td>
                                                    <td>{{ $equipamento->equipamento->equipamento }}</td>
                                                    <td>{{ $equipamento->quantidade }}</td>
                                                    <td>{{ $equipamento->observacoes }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="endereco"><small class="text-danger">*</small> Endereço de Instalação</label>
                            <input type="text" class="form-control" id="endereco" 
                            value="{{ $assinatura->endereco }}"
                            name="endereco">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="numero"><small class="text-danger">*</small> Nº</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->numero }}"
                            id="numero" name="numero" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="bairro"><small class="text-danger">*</small> Bairro</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->endereco }}"
                            id="bairro" name="bairro" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cep"><small class="text-danger">*</small> CEP</label>
                            <input type="text" 
                            value="{{ $assinatura->cep }}"
                            class="form-control cep" id="cep" name="cep">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complemtento"><small class="text-danger">*</small> Complemento</label>
                            <input type="text" class="form-control complemento" 
                            value="{{ $assinatura->complemento }}"
                            id="complemento" name="complemento" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="estado"><small class="text-danger">*</small> Estado</label>
                            <input type="hidden" name="estado" id="estado" 
                            value="{{ $assinatura->state_id }}"
                            class="form-control">
                            <input type="text" name="estado2" 
                            value="{{ $assinatura->state->nome }}"
                            id="estado2" class="form-control">
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cidade"><small class="text-danger">*</small> Cidade</label>
                            <input type="hidden" name="cidade" 
                            id="cidade" value="{{ $assinatura->city_id }}"
                            class="form-control" required>
                            <input type="text" name="cidade2" 
                            value="{{ $assinatura->city->nome }}"
                            id="cidade2" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dia_vcto"><small class="text-danger">*</small> Vencimento</label>
                            <select class="form-control" id="dia_vcto" 
                            name="dia_vcto" required>
                                
                                <?php
                                $i = 0;
                                while ($i < 35) { ?>
                                    <option {{ ($assinatura->dia_vencimento == $i) ? 'selected' : '' }} value='<?php if ($i == 0) {
                                                        echo $i + 1;
                                                    } else if ($i == 30) {
                                                        echo $i - 2;
                                                    } else {
                                                        echo $i;
                                                    } ?>'>
                                        Todo dia <?php if ($i == 0) {
                                                        echo $i + 1;
                                                    } else if ($i == 30) {
                                                        echo $i - 2;
                                                    } else {
                                                        echo $i;
                                                    } ?></option>
                                <?php $i += 5;
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="periodo"><small class="text-danger">*</small> Periodo</label>
                            <select class="form-control "  id="periodo" name="periodo">
                                <option value="1" {{ ($assinatura->periodo == 1) ? 'selected' : '' }}>Mensal</option>
                                <option value="2" {{ ($assinatura->periodo == 2) ? 'selected' : '' }}>Bimestral</option>
                                <option value="3" {{ ($assinatura->periodo == 3) ? 'selected' : '' }}>Trimestral</option>
                                <option value="6" {{ ($assinatura->periodo == 6) ? 'selected' : '' }}>Semestral</option>
                                <option value="12" {{ ($assinatura->periodo == 12) ? 'selected' : '' }}>Anual</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vcto"><small class="text-danger">*</small> Data do Primeiro Pagamento</label>
                            <input type="date" class="form-control" 
                            value="{{ $assinatura->vencimento }}"
                             id="vcto" name="vcto" placeholder="">
                            <input type="hidden" 
                            value="{{ $assinatura->vencimento }}"
                            name="entrada2" id="entrada2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="taxainstalacao">Taxa De Instalação</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->taxa_instalacao }}"
                            id="taxainstalacao" name="taxainstalacao" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="desconto">Desconto</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->desconto }}"
                            id="desconto" name="desconto" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="acrescimo">Acréscimo</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->acrescimo }}"
                            id="acrescimo" name="acrescimo" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="valor"><small class="text-danger">*</small> Valor</label>
                            <input type="text" class="form-control" 
                            value="{{ $assinatura->valor }}"
                            id="valor" name="valor" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-3" aria-disabled="" id="isento_mensalidade">
                        <label for=""><small class="text-danger">*</small> Insento Mensalidade</label>
                        <div class="btn-group  btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-success">
                                <input type="radio" class="isento_mensalidade" 
                                {{ ($assinatura->isento_mensalidade == 1) ? 'checked':'' }}
                                name="isento_mensalidade" id="option_isento1" value="1" autocomplete="off"> Sim
                            </label>
                            <label class="btn btn-success active">
                                <input type="radio" class="isento_mensalidade" 
                                {{ ($assinatura->isento_mensalidade == 0) ? 'checked':'' }}
                                name="isento_mensalidade" id="option_isento2" value="0" 
                                autocomplete="off" checked> Não
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for=""><small class="text-danger">*</small> Bloqueio Automático</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-success active">
                                <input type="radio" class="bloqueio_automatico" 
                                {{ ($assinatura->bloqueio_automatico == 1) ? 'checked':'' }}
                                name="bloqueio_automatico" id="option1" value="1" autocomplete="off" checked> Sim
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" class="bloqueio_automatico" 
                                {{ ($assinatura->bloqueio_automatico == 0) ? 'checked':'' }}
                                name="bloqueio_automatico" id="option2" value="0" autocomplete="off"> Não
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for=""><small class="text-danger">*</small> Permitir Alterar Senha</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-success active">
                                <input type="radio" class="permitir_alterar_senha" 
                                {{ ($assinatura->permitir_alterar_senha == 1) ? 'checked':'' }}
                                name="permitir_alterar_senha" id="option1" value="1" autocomplete="off" checked> Sim
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" class="permitir_alterar_senha" 
                                {{ ($assinatura->permitir_alterar_senha == 0) ? 'checked':'' }}
                                name="permitir_alterar_senha" id="option2" value="0" autocomplete="off"> Não
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for=""><small class="text-danger">*</small> Status</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-success active">
                                <input type="radio" class="situacao_cliente" 
                                {{ ($assinatura->status == 1) ? 'checked':'' }}
                                name="situacao_cliente" id="situacao1" value="1" autocomplete="off"> Ativo
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" class="situacao_cliente" 
                                {{ ($assinatura->status == 0) ? 'checked':'' }}
                                name="situacao_cliente" id="situacao2" value="0" autocomplete="off"> Bloqueado
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <hr>
                <input type="hidden" name="vctoCliente" id="vctoCliente">
                <button id="save" type="submit" class="btn btn-success" 
                onclick="updateAssinatura()">
                    <i class="fa fa-plus"></i> Actualizar Assinatura</button>
            </div>
        </form>


    </div>
    <!-- /.box -->

</div>

</div>

<script>

    $(function() {
        $("#ip").inputmask("999.999.999.999");
        $("#mac").inputmask("**.**.**.**.**.**");
        $("#cep").inputmask("99999-999");
    })

    $("#plano, #desconto, #acrescimo").bind("change keydown", function() {
        var plano = $("#plano").val();
        var desconto = $("#desconto").val();
        var acrescimo = $("#acrescimo").val();
        var isento = $("input[name='isento_mensalidade']:checked").val();

        //alert(isento);
        if (isento > 0) {
            $.ajax({
                url: '/admin/valor-plano',
                type: "GET",
                data: 'plano=' + plano + '&desconto=' +
                    desconto + '&acrescimo=' + acrescimo + '&isento=' + isento,
                beforeSend: function() {

                },
                success: function(data) {
                    // alert(data);
                    $("#valor").val(data);
                },
                error: function() {

                }
            });
        } else {
            alert("Por Favor! Selecione Um Plano.")
        }

    });

    $("#option_isento1").bind("change click keydown keypress keyup focus", function() {
        var plano = $("#plano").val();
        var desconto = $("#desconto").val();
        var acrescimo = $("#acrescimo").val();
        var isento = $("input[name='isento_mensalidade']:checked").val();

        $.ajax({
            url: '/admin/valor-plano',
            type: "GET",
            data: 'plano=' + plano + '&desconto=' +
                desconto + '&acrescimo=' + acrescimo + '&isento=' + isento,
            beforeSend: function() {

            },
            success: function(data) {
                //alert(data);
                $("#valor").val(data);
                $("#taxainstalacao").attr('disabled', true);
            },
            error: function() {

            }
        });
    });

    $("#option_isento2").bind("change click keydown keypress keyup focus", function() {
        var plano = $("#plano").val();
        var desconto = $("#desconto").val();
        var acrescimo = $("#acrescimo").val();
        var isento = $("input[name='isento_mensalidade']:checked").val();

        $.ajax({
            url: '/admin/valor-plano',
            type: "GET",
            data: 'plano=' + plano + '&desconto=' +
                desconto + '&acrescimo=' + acrescimo + '&isento=' + isento,
            beforeSend: function() {

            },
            success: function(data) {
                //alert(data);
                $("#valor").val(data);
                $("#taxainstalacao").attr('disabled', false);
            },
            error: function() {

            }
        });
    });

    $("#dia_vcto, #periodo").change(function() {
        var vcto = $("#dia_vcto").val();
        var entrada = $("#entrada2").val();
        var periodo = $("#periodo").val();
        $.ajax({
            url: '/admin/alterar-entrada',
            type: "GET",
            data: 'vcto=' + vcto + '&entrada=' + entrada + '&periodo=' + periodo,
            beforeSend: function() {

            },
            success: function(data) {
                // alert(data);
                $("#vcto").val(data);
            },
            error: function() {

            }
        });
    });

    function addEquipamentos() {

        var Equipamento = {
            codigo: $('#equipamento').val(),
            nome: $('#equipamento option:selected').text(),
            quantidade: $('#qtd_utilizado').val(),
            observacoes: $('#observacoes').val(),
        }
        addRow(Equipamento);
    }

    function addRow(Equipamento) {

        var qty = $("#equipamento_qty").val();

        if (Number(Equipamento.codigo > 0) && Number(Equipamento.quantidade >= 0)) {
            if (qty < Number(Equipamento.quantidade)) {
                alert("Quantidade maior que o stock.")
            } else {

                var table_data = [];
                var json_table = [];
                var error;

                $('#equipamentosLst tbody tr').each(function(row, tr) {
                    var sub = {
                        'codigo': $(tr).find('td:eq(1)').text(),
                        'quantidade': $(tr).find('td:eq(3)').text(),
                        'observacoes': $(tr).find('td:eq(4)').text(),
                    };

                    table_data.push(sub);
                    json_table = JSON.stringify(table_data);

                });

                // console.log(json_table);

                // for (var i = 0, len = json_table.length; i < len; i++) {
                //     if (json_table[i][0] === Equipamento.codigo) {
                //         alert("Este equipamento já existe! Remova se quiser editar.");
                //         error = 1;
                //     } 
                // }

                console.log(table_data);

                table_data.map(function (table_data) {
                if (table_data.codigo == Equipamento.codigo) {
                    alert("Este equipamento já existe! Remova se quiser editar.");
                    error = 1;
                } else {
                    //return null
                }
                });

                if(error != 1) {
                    var $tableB = $("#equipamentosLst tbody");
                    var $row = $(
                        "<tr>" +
                        "<td><button name='record' onclick='deleterow(this)' class='btn btn-warning btn-xs'>Remover</button></td>" +
                        "<td>" + Equipamento.codigo + "</td>" +
                        "<td>" + Equipamento.nome + "</td>" +
                        "<td>" + Equipamento.quantidade + "</td>" +
                        "<td>" + Equipamento.observacoes + "</td>" +
                        "</tr>"
                    );

                    $row.data("codigo", Equipamento.codigo);
                    $row.data("nome", Equipamento.nome);
                    $row.data("quantidade", Equipamento.quatidade);
                    $row.data("observacoes", Equipamento.observacoes);
                    $tableB.append($row);

                    $('#equipamento option:first').attr('selected', true);
                    $('#qtd_utilizado').val('');
                    $('#observacoes').val('');
                    $("#equipamento").focus();
            }
            }
        } else {
            alert("Selecione um equipamento.")
        }
    }

    function deleterow(e) {
        $("#equipamento").focus();
        $(e).parent().parent().remove();
    }

    function equipamentoQty() {
        // pesquisando a quantidade disponivel de um equipamento.
        var id = $("#equipamento").val();
        $.ajax({
            url: '/admin/equipamentoget/' + id,
            type: "GET",
            success: function(data) {
                console.log(data);
                $('#equipamento_qty').val(data);
                $("#qtd_utilizado").attr("max", data);
                if (Number($('#equipamento_qty').val() < Number($('#qtd_utilizado').val()))) {
                    $('#quantidade').val(data);
                }
            },
            error: function() {}
        });

    }

    function clienteData() {

        var id = $("#cliente").val();

        $.ajax({
            type: 'GET',
            url: '/admin/get-customer/' + id,
            dataType: 'JSON',
            beforeSend: function() {
                $('#cep').val("Carregando...");
                $('#complemento').val("Carregando...");
                $('#cidade2').val("Carregando...");
                $('#login').val("Carregando...");
                $('#password').val("Carregando...");
                $('#numero').val("Carregando...");
                $('#bairro').val("Carregando...");
                $('#estado2').val("Carregando...");
                //$('#periodo').val("Carregando...");
                $('#endereco').val("Carregando...");
            },
            success: function(data) {
                var mydata = data;
                //console.log(mydata);

                
                $("#periodo, #dia_vcto, #vcto").attr('disabled', false);

                $('#cep').val(mydata.cep);
                $('#complemento').val(mydata.complemento);
                $('#cidade').val(mydata.cidade);

                $('#numero').val(mydata.numero);
                $('#bairro').val(mydata.bairro);
                $('#endereco').val(mydata.endereco);

                $('#login').val(mydata.login);
                $('#password').val(mydata.pw);

                $('#cidade2').val(mydata.cidade_nome);
                $('#estado').val(mydata.estado);
                $('#estado2').val(mydata.estado_nome);

                //$('#periodo').val(mydata.periodo + " meses");
                //$('#vctoCliente').val(mydata.vcto);

                $('#vcto').val(mydata.entrada);
                $('#entrada2').val(mydata.entrada2);

                if (Number(mydata.status) == 1) {
                    $("#situacao1").attr('checked', 'checked');
                } else {
                    $("#situacao2").attr('checked', 'checked');
                }
                
            },
            error: function() {
                alert('alterado');
            }
        });
    }

    function updateAssinatura() {

        var table_data = [];
        var json = [];

        $('#equipamentosLst tbody tr').each(function(row, tr) {
            var sub = {
                'codigo': $(tr).find('td:eq(1)').text(),
                'quantidade': $(tr).find('td:eq(3)').text(),
                'observacoes': $(tr).find('td:eq(4)').text(),
            };

            table_data.push(sub);
            json = JSON.stringify(table_data);

        });

        console.log(json);

        if ($("#dia_vcto").val() == '' ||
            $("#cliente").val() == '' ||
            $("#plano").val() == '' ||
            $("#tipo_auth").val() == '') {

            alert("Por Favor! Preencha os Campos Obrigatórios.");

        } else {
            $.ajax({
                type: "POST",
                url: "/admin/assinatura/update/{{ $assinatura->id }}",
                dataType: "JSON",
                data: {
                    _token: "{{ csrf_token() }}",
                    cliente: $("#cliente").val(),
                    plano: $("#plano").val(),
                    ip: $("#ip").val(),
                    mac: $("#mac").val(),
                    tipo_auth: $("input[name='tipo_auth']:checked").val(),
                    login: $("#login").val(),
                    password: $("#password").val(),
                    endereco: $("#endereco").val(),
                    numero: $("#numero").val(),
                    bairro: $("#bairro").val(),
                    cep: $("#cep").val(),
                    complemento: $("#complemento").val(),
                    estado: $("#estado").val(),
                    cidade: $("#cidade").val(),
                    vcto: $("#vcto").val(),
                    dia_vcto: $("#dia_vcto").val(),
                    valor: $("#valor").val(),
                    periodo: $("#periodo").val(),
                    desconto: $("#desconto").val(),
                    taxainstalacao: $("#taxainstalacao").val(),
                    acrescimo: $("#acrescimo").val(),
                    isento_mensalidade: $("input[name='isento_mensalidade']:checked").val(),
                    bloqueio_automatico: $("input[name='bloqueio_automatico']:checked").val(),
                    permitir_alterar_senha: $("input[name='permitir_alterar_senha']:checked").val(),
                    situacao_cliente: $("input[name='situacao_cliente']:checked").val(),
                    data: json

                },
                success: function(data) {

                    console.log(data);
                    var mydata = data;
                    last_id = mydata.last_id;
                    //alert(data)
                    if(data === 1) {
                        window.location.href = "/admin/assinaturas";
                    }
                    window.location = "<?=BASE_URL;?>/admin/assinaturas";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

</script>
@endsection
