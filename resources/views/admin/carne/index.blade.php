@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Carnes')

@section('content')
<div class="container bg-white px-4 py-4 border" style="max-width: 1000px">


    <h2>Gerenciar Carnê Simples</h2>

    <div
        <div>
            <h2>Carnês</h2>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="cliente"><small class="text-danger">*</small> Cliente</label>
                        <select class="form-control cliente" onchange="carregarCarnes()" id="cliente" name="cliente">
                            <option value="" selected disabled>Selecione</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->user->id }}">{{ $cliente->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="estado"><small class="text-danger">*</small> Estado</label>
                        <select class="form-control estado" onchange="carregarCarnes()" id="estado" name="cliente">
                            <option value="3" selected>Todos</option>
                            <option value="1">Pago</option>
                            <option value="0">Aberto</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="cliente">Pesquisar</label>
                        <button class="btn btn-info form-control" onclick="carregarCarnes()"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="cliente">Imprimir</label>
                        <button class="btn btn-primary form-control" onclick="carregarCarnes()"><i class="fa fa-file"></i> Imprimir</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="checkbox">
                <label for="checkall">
                    <input type="checkbox" name="" id="checkall"> Selecionar todos os carnês
                </label>
            </div>
            <div id="carnesselecionados"></div>
            <div>
                Com os selecionados:
                <a href="#" class="text-success" onclick="baixarSelecionados()" style="cursor: pointer">Baixar</a>,
                <a class="text-danger" onclick="excluirSelecionados()" style="cursor: pointer">Excluir</a>,
                <a href="<?= BASE_URL; ?>/admin/carne/imprimir" class="text-prrimary">Imprimir</a> | 
                <a href="<?= BASE_URL; ?>/admin/carne/imprimir?capa" class="text-prrimary">Imprimir Com Capa</a>
            </div>
            <hr />
            <div style="">
                <table style=" width:100%;font-size:90%; display: none;" id="usuarios" width="100%" cellspacing="0" ~ class="table table-striped 
            table-bordered">
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <!-- <td></td>
                            <td></td> -->
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>


    <script>
        pegarCarnesChecados();

        // checar todos os carnes
        $("#checkall").change(function() {
            $("input:checkbox").prop("checked", $(this).prop("checked"));
            pegarCarnesChecados();
        });

        // ao alterar o checbox actualizar os carnes checados
        $('.checkitem').change(function() {
            console.log("Aletrado...")
        });

        function pegarCarnesChecados() {
            var result = $('.checkitem:checked');
            if (result.length > 0) {
                
                var resultValue = [];
                result.each(function() {
                    resultValue.push($(this).val())
                });

                // alert(resultValue);
                total = resultValue.length;

                // passar os dados para o localstorage para que esteja disponivel em todas páginas
                localStorage.carnes = resultValue
                document.cookie = "carnes="+localStorage.carnes;

                $("#carnesselecionados").text(total + ' Carnês selecionados: ' + resultValue)
            } else {
                $("#carnesselecionados").text("Nenhum carnê selecionado.")
            }
        }

        // carregando os usuários com datatable
        function carregarCarnes() {

            // deschecar o checkbox que seleciona todos
            $("#checkall").prop("checked", false);
            $("#carnesselecionados").text("Nenhum carnê selecionado.")

            // First -- Convert plain text to search field inputs
            $('.table thead tr:first th.searchable:not(.datatables-dropdown)').each(function() {
                var title = $(this).text().trim();
                $(this).css({
                    "padding": "5px"
                });
                $(this).html('<input type="text" placeholder="' + title + '" style="width: 115px;" />');
            });

            jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

            var cliente = $('#cliente').val();
            var estado = $('#estado').val();

            // alert(cliente + '-' + estado)

            if (!cliente) {
                alert("Selecione um cliente");
            } else {

                $.ajax({
                    url: '/admin/loadcarnes',
                    type: 'GET',
                    data: '_token={{ csrf_token() }}' + '&cliente=' + cliente + '&estado=' + estado,
                    dataType: 'JSON',
                    success: function(data) {
                        $("#usuarios").css("display", "");
                        if (data.length > 0) {
                            var table = $('#usuarios').dataTable({
                                "language": {
                                    "url": "/assets/js/datatable-pt-br.json"
                                },
                                "aaData": data,
                                "bDestroy": true,
                                "pageLength": 50,
                                "aoColumns": [{
                                        "sTitle": "Status",
                                        "mData": "id",
                                        "render": function(mData, type, row, meta) {
                                            return '<div class=""><input onclick="pegarCarnesChecados()"\
                                                type="checkbox" class="checkitem" value="' + mData + '"\
                                                id="exampleCheck1"></div>';
                                        }
                                    },
                                    // {
                                    //     "sTitle": "ID",
                                    //     "mData": "id"
                                    // },
                                    // {
                                    //     "sTitle": "Cliente ID",
                                    //     "mData": "cliente"
                                    // },
                                    {
                                        "sTitle": "Cliente Nome",
                                        "mData": "nomeCliente"
                                    },
                                    // {
                                    //     "sTitle": "Assinatura",
                                    //     "mData": "assinatura"
                                    // },
                                    {
                                        "sTitle": "Plano",
                                        "mData": "planoNome"
                                    },
                                    {
                                        "sTitle": "Valor",
                                        "mData": "valor"
                                    },
                                    {
                                        "sTitle": "Status",
                                        "mData": "status",
                                        "render": function(mData, type, row, meta) {
                                            if (mData == 1) {
                                                return '<pan class="" style="background:green; color:#fff; padding:5px;">Pago</span>';
                                            } else {
                                                return '<pan style="background:blue; color:#fff; padding:5px;">Aberto</span>';
                                            }
                                        }
                                    },
                                    {
                                        "sTitle": "Acções",
                                        "mData": "id",
                                        "render": function(mData, type, row, meta) {
                                            return '<a class="text-danger" style="cursor: pointer" onclick="excluir(' + mData + ')">Excluir</a>, <a class="text-success" style="cursor: pointer" onclick="baixar(' + mData + ')">Baixar</a>';
                                        }
                                    },
                                    {
                                        "sTitle": "Data Vencimento",
                                        "mData": "data_vcto"
                                    }
                                ]
                            });
                        } else {
                            $("#usuarios").css("display", "none");
                            alert("Sem informações.");
                        }

                    },
                    error: function(xhr) {
                        // console.log('Estado da requisição: ' + xhr.status);
                        // console.log('Status texto: ' + xhr.statusText);
                        // console.log(xhr.responseText);
                        // // var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                        // // console.log(text);
                    }
                });
            }

        }

        function baixarSelecionados() {
            var result = $('.checkitem:checked');
            if (result.length > 0) {
                result.each(function() {
                    carne = $(this).val();

                    $.ajax({
                        url: '/admin/carne/baixar/'+carne,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            if (data == 2) {
                                alert("Ocorreu um erro.")
                            } else {
                            }

                        },
                        error: function(xhr) {
                            // console.log('Estado da requisição: ' + xhr.status);
                            // console.log('Status texto: ' + xhr.statusText);
                            // console.log(xhr.responseText);
                            // // var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                            // // console.log(text);
                        }
                    });

                });

                carregarCarnes();
            } else {
                $("#carnesselecionados").text("Nenhum carnê selecionado.")
            }
        }

        function excluirSelecionados() {
            var result = $('.checkitem:checked');
            if (result.length > 0) {
                result.each(function() {
                    
                    carne = $(this).val();

                    $.ajax({
                        url: '/admin/carne/delete/'+carne,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            if (data == 2) {
                                alert("Ocorreu um erro.")
                            } else {
                            }

                        },
                        error: function(xhr) {
                            // console.log('Estado da requisição: ' + xhr.status);
                            // console.log('Status texto: ' + xhr.statusText);
                            // console.log(xhr.responseText);
                            // // var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                            // // console.log(text);
                        }
                    });

                });

                carregarCarnes();
            } else {
                $("#carnesselecionados").text("Nenhum carnê selecionado.")
            }
        }

        function excluir(carne = 12) {
            $.ajax({
                url: '/admin/carne/delete/'+carne,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data == 2) {
                        alert("Ocorreu um erro.")
                    } else {
                        carregarCarnes();
                    }

                },
                error: function(xhr) {
                    // console.log('Estado da requisição: ' + xhr.status);
                    // console.log('Status texto: ' + xhr.statusText);
                    // console.log(xhr.responseText);
                    // // var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                    // // console.log(text);
                }
            });
        }

        function baixar(carne = 12) {
            $.ajax({
                url: '/admin/carne/baixar/'+carne,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data == 2) {
                        alert("Ocorreu um erro.")
                    } else {
                        carregarCarnes();
                    }

                },
                error: function(xhr) {
                    // console.log('Estado da requisição: ' + xhr.status);
                    // console.log('Status texto: ' + xhr.statusText);
                    // console.log(xhr.responseText);
                    // // var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                    // // console.log(text);
                }
            });
        }
    </script>
    
</div>
@endsection