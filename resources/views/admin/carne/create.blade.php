@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Carnê Simples')

@section('content')

<div class="container bg-white px-4 py-4 border">
    <h2>Criar Carnê Simples</h2>
    <hr>
<div class="row">
    <div class="col-md-12">
        <form id="frmCarne" method="POST" action="scripts/carnes/criar_carne.php">
            <div class="row">
                <div class="col-md-12" id="message"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cliente"><small class="text-danger">*</small> Cliente</label>
                        <select class="form-control cliente" id="cliente" name="cliente">
                            <option value="" selected disabled>Selecione</option>

                            <?php $user = 0;
                            if(isset($_GET['user'])) {
                                $user = (int)$_GET['user'];
                            } ?>

                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->user->id }}" {{ ($user === $cliente->user->id) ? 'selected':'' }}>{{ $cliente->user->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="plano" id="plano">
                        <input type="hidden" name="valor" id="valor">
                        <input type="hidden" name="assinatura" id="assinatura">
                        <input type="hidden" name="nome_plano" id="nome_plano">
                        <input type="hidden" name="nome_cliente" id="nome_cliente">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_criacao">Data</label>
                        <input type="date" class="form-control" id="data_criacao" name="data_criacao" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_vcto">Último Vencimento</label>
                        <span id="dataVcto">
                            <input type="date" class="form-control" id="data_vcto" name="data_vcto" value="<?php echo date('Y-m-d'); ?>">
                        </span>
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quantidade">Quantidade de Carnês</label>
                        <input type="number" class="form-control" min="1" id="quantidade" name="quantidade" value="1">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" id="observacoes" name="observacoes" placeholder="Observações" />
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="button" id="save" class="btn form-control btn-primary" onclick="addCarne()">Gerar</button>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-12">

        <div id="success"></div>

        <div style="background: #fff; min-height: 20em;" class="border p-3">
            <h4 class="text-uppercase">Carnês Gerados</h4>
            <table class="table table-bordered table-striped" id="carneLista">
                <thead>
                    <tr>
                        <th>Nome Cliente</th>
                        <th>Plano</th>
                        <th style="display: none">ID Cliente</th>
                        <th style="display: none">ID Plano</th>
                        <th style='width: 110px'>valor</th>
                        <th>Vencimento</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button class="btn btn-success" id="gerar_carne" onclick="criarCarnes()">Salvar Carnês</button>
        </div>
    </div>
</div>


<script>

    function addCarne() {

        var quantidade = $('#quantidade').val();

        if (!$('#cliente').val()) {
            alert("Por favor selecione um cliente")
        } else {
            var i = 0;

            var dataVcto = $('#data_vcto').val()

            while (i < quantidade) {

                var d = new Date(dataVcto);

                // de = d.getFullYear()+ '-'+d.getDate()+'-'+d.getDate();

                d.setDate(d.getDate() + 30);
                if(Number((d.getMonth()+1)) < 10) {
                    month = "0"+(d.getMonth()+1)
                } else {
                    month = (d.getMonth()+1);
                }

                if(Number(d.getDate()) < 10) {
                    day = "0"+(d.getDate())
                } else {
                    day = (d.getDate());
                }

                var dataVcto = d.getFullYear()+ '-'+month+'-'+day;
                var novaData = dataVcto;

                //date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear()
                //dataVcto = new Date(dataVcto);
                console.log(dataVcto);

                
                var Carne = {
                    // id: id,
                    nome_cliente: $('#nome_cliente').val(),
                    nome_plano: $('#nome_plano').val(),
                    cliente: $('#cliente').val(),
                    plano: $('#plano').val(),
                    valor: $('#valor').val(),
                    vencimento: dataVcto,
                }

                addRow(Carne);
                i++;

                if(i == quantidade) {
                    $('#dataVcto').html("<input type='date' id='data_vcto' value='" + dataVcto + "' class='form-control'/>");
                    $('#quantidade').val(1);
                }
            }

            

            
            document.getElementById("cliente").disabled = true;
            /*document.getElementById("data_criacao").disabled = true;
            document.getElementById("data_vcto").disabled = true;
            document.getElementById("quantidade").disabled = true;
            document.getElementById("observacoes").disabled = true;
            */
        }


        // $("#frmCarne")[0].reset();
        // $("#save").prop('disabled', true);
        $("#cliente").focus();
    }

    function myYmd(D) {
        var pad = function(num) {
            var s = '0' + num;
            return s.substr(s.length - 2);
        }
        var Result = pad(D.getDate()) + '/' + pad((D.getMonth() + 1)) + '/' + D.getFullYear();
        return Result;
    }

    function addRow(Carne) {
        var $tableB = $("#carneLista tbody");

        let valor = Carne.valor;
        valor = (valor.toLocaleString());

        var $row = $(
            "<tr>" +
            "<td>" + Carne.nome_cliente + "</td>" +
            "<td style='width: 120px'>" + Carne.nome_plano + "</td>" +
            "<td style='display: none'>" + Carne.cliente + "</td>" +
            "<td style='display: none'>" + Carne.plano + "</td>" +
            "<td id='valor'><input type='text' value='" + valor + "' class='form-control'/></td>" +
            "<td style='width: 100px'> <input type='date' value='" + Carne.vencimento + "' class='form-control'/></td>" +
            "</tr>"
        );
        $row.data("id", Carne.id);
        $row.data("cliente", Carne.cliente);
        $row.data("plano", Carne.plano);
        $row.data("valor", Carne.valor);
        $row.data("vencimento", Carne.vencimento);
        $row.data("estado", "Aberto");

        $tableB.append($row);
    }

    function formatarMoeda(numero) {
        //numero = numero.replace(/[^0-9]+/g, "");

        // if (numero.length > 1) {
        //     numero = numero.substring(0, 1) + "." + numero.substring(1);
        // }

        // if (numero.length > 8) {
        //     numero = numero.substring(0, 4) + "." + numero.substring(4, 7);
        // }

        // if (numero.length > 7) {
        //     numero = numero.substring(0, 7) + "." + numero.substring(7);
        // }

        return numero;
    }

    function criarCarnes() {

        var table_data = [];
        $('#carneLista tbody tr').each(function(row, tr) {
            var valor = $(tr).find('td:eq(4)').find('input').val();
            var dataVencimento = $(tr).find('td:eq(5)').find('input').val();
            var sub = {
                'cliente': $(tr).find('td:eq(2)').text(),
                'plano': $(tr).find('td:eq(3)').text(),
                'valor': valor,
                'vencimento': dataVencimento,
            };
            console.log(dataVencimento)
            table_data.push(sub);
        });

        console.log(table_data);
        
        $.ajax({
            type: "POST",
            url: "/admin/carne/store",
            dataType: "JSON",
            data: {
                _token: "{{ csrf_token() }}",
                data: table_data
            },
            beforeSend: function() {
                $('#success').html('Aguarde por favor...').addClass('fixed-notification');
            },
            success: function(data) {

                let msg;

                msg = data.quantidade_carnes + " carnês gerados com sucesso";

                setTimeout(function() {
                     $('#success').html('').removeClass('fixed-notification');
                }, 6000);

                document.getElementById("gerar_carne").disabled = true;
                document.getElementById("save").disabled = true;
                $('#success').html(msg).addClass('fixed-notification');

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $(function() {

        loadCliente();

        $("#cliente").change(function() {

            var id = $("#cliente").val();

            $.ajax({
                type: 'GET',
                url: '/admin/get-customer/' + id,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#plano').val("Carregando...");
                    $('#valor').val("Carregando...");
                    $('#message').val("Carregando...");
                },
                success: function(data) {
                    var mydata = data;
                    //console.log(mydata);
                    $('#message').val("");
                    $('#plano').val(mydata.plano_id);
                    $('#nome_plano').val(mydata.plano);
                    $('#nome_cliente').val(mydata.nomeCliente);
                    $('#valor').val(mydata.valor);
                    $('#assinatura').val(mydata.assinaturaId);
                    $('#data_criacao').val(mydata.entrada2);
                    $('#data_vcto').val(mydata.vcto);

                },
                error: function() {
                    alert('Houve um erro. Tente de novo por favor.');
                }
            });
        });
    });

    function loadCliente() {

            var id = $("#cliente").val();
            if(id > 0) {
            $.ajax({
                type: 'GET',
                url: '/admin/get-customer/' + id,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#plano').val("Carregando...");
                    $('#valor').val("Carregando...");
                    $('#message').val("Carregando...");
                },
                success: function(data) {
                    var mydata = data;
                    //console.log(mydata);
                    $('#message').val("");
                    $('#plano').val(mydata.plano_id);
                    $('#nome_plano').val(mydata.plano);
                    $('#nome_cliente').val(mydata.nomeCliente);
                    $('#valor').val(mydata.valor);
                    $('#assinatura').val(mydata.assinaturaId);
                    $('#data_criacao').val(mydata.entrada2);
                    $('#data_vcto').val(mydata.vcto);

                },
                error: function() {
                    alert('Houve um erro. Tente de novo por favor.');
                }
            });

        }
    }

</script>
</div>
@endsection