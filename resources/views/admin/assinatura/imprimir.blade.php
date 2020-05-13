<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Assinatura</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    html,
    body {
      height: 100%;
    }
  
    body {
      background: #444;
      padding: 25px;
    }
  
    @media print {
      .button {
        display: none;
      }
    }
  
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }
  
      body {
        padding-top: 72px;
        padding-bottom: 72px;
      }
    }
  </style>
  <script>
    function printFunction() {
      var buttons = document.getElementById("buttons");
      var print = document.getElementById("print");
      buttons.style.display = 'none';
      print.style.overflow = 'hidden';
      print.style.position = 'relative';
      window.print();
    }
  
    window.onafterprint = function(e) {
      closePrintView();
    };
  
    function closePrintView() {
      window.close();
    }
  </script>
  
  <body>
  
    <div class="" style="height: 100%">
      <div style="
        margin: 0 auto; 
        text-align: center;
        width: 100%; max-width: 1000px; 
        margin: 0 auto; 
        " id="buttons" class="mb-1">
        <div class="row">
          <div class="col-md-6"><button onclick="printFunction()" class="form-control btn btn-primary">Imprimir</button></div>
          <div class="col-md-6"><button onclick="window.location.href='/admin/assinaturas'" class="form-control btn btn-primary">Fechar</button></div>
        </div>      
        <br>
      </div>
      <div id="print" class="print mt-4" style="
      max-width: 794px; 
      padding: 10px; 
      border: 2px solid #444444;
      margin: 0 auto; 
      background: #ffff;">
        <div align="right">
          Nº CONTRATO: <b> {{ $assinatura->id }} </b>
        </div>
  
        <h3 align="center">TERMO DE ADESÃO</h3>
        <br>
        <table class="table table-responsive table-bordered " width="100%" style="width: 100%; max-width: 100%; overflow-x: auto;">
          <thead>
            <tr>
              <td colspan="5" style="padding: 10px 10px"><b>DADOS DA CONTRATADA</b></td>
            </tr>
            <tr>
              <td class="text-center" colspan="5">
                {{ $config->name }}, <b>ENDEREÇO:</b> {{ $config->endereco }},
                <b>CIDADE:</b> {{ $config->city->nome }} -
                <b>ESTADO:</b> {{ $config->state->nome }} -
                <b>CNPJ:</b> {{ $config->cnpj }} -
                <b>TELEFONE:</b> {{ $config->telefone }} / {{ $config->celular }}
              </td>
            </tr>
            <tr>
              <td colspan="5" style="padding:10px 10px"><b>DADOS DO CONTRATANTE</b></td>
            </tr>
            <tr>
              <td colspan="5">
                <b>NOME COMPLETO: </b> {{ $assinatura->user->name }}
              </td>
  
            </tr>
            <tr>
                <?php 
                use App\Models\Customer;
                $cliente = Customer::where('user_id', $assinatura->user_id)->first(); 
                ?>
              <td colspan="2"><b>CPF: </b> {{ $cliente->cpf }}</td>
              <td colspan="3"><b>RG: </b> {{ $cliente->rg }}</td>
            </tr>
  
            <tr>
              <td colspan="3"><b>Endereço: </b> {{ $assinatura->endereco }}</td>
              <td colspan="2"><b>Nº: </b> {{ $assinatura->numero }}</td>
            </tr>
  
            <tr>
              <td colspan="3"><b>Bairro: </b> {{ $assinatura->bairro }}</td>
              <td colspan="2"><b>Cidade: </b> {{ $assinatura->city->nome }}</td>
  
            </tr>
  
            <tr>
              <td colspan="3"><b>CEP: </b> {{ $assinatura->cep }}</td>
              <td colspan="2"><b>TELEFONE: </b> {{ $assinatura->user->phone }}</td>
  
            </tr>
            <tr>
              <td colspan="5" style="padding: 10px 10px"><b>OBJETO</b></td>
            </tr>
            <tr>
              <td colspan="5">
                Constitui objeto do presente TERMO DE ADESÃO à prestação pela CONTRATADA em favor do CONTRATANTE do(s) serviço(s) de acordo com os termos e condições previstos no CONTRATO DE PRESTAÇÃO DE SCM - SERVIÇOS DE COMUNICAÇÃO MULTIMÍDIA registrado junto ao cartório único de notas e registros de Tuparetama.
                O CONTRATANTE, declara ter lido e entendido o CONTRATO objeto deste TERMO DE ADESÃO, que juntos forma um só instrumento de direito, e está ciente que a assinatura deste instrumento representa expressa concordância aos termos e condições declarados no mesmo. Declara, ainda que recebeu uma via deste termo.
              </td>
            </tr>
            <tr>
              <td colspan="5" style="padding: 10px 10px"><b>DADOS DE SERVIÇO</b></td>
            </tr>
            <tr border="1">
              <td>Plano</td>
              <td>VALOR DA MENSALIDADE</td>
              <td>VENCIMENTO</td>
              <td>DATA DA ATIVAÇÃO</td>
              <td>VALOR DA TAXA DE ATIVAÇÃO</td>
            </tr>
            <tr border="1">
              <td>{{ $assinatura->plano->nome }}</td>
              <td> {{ currencyFormat($assinatura->valor) }} </td>
              <td>{{ dateFormat($assinatura->vencimento) }}</td>
              <td>
                {{ dateFormat($assinatura->created_at) }}
              </td>
              <td>{{ currencyFormat($assinatura->taxa_instalacao) }}</td>
            </tr>
            <tr>
              <td colspan="5"><b>EQUIPAMENTOS EM COMODATO</b></td>
            </tr>
            @if(count($assinatura->equipamentos) > 0)
            <tr>
              <td colspan="5">
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
              <td colspan="5" style="padding: 10px"><b>ASSINATURA</b></td>
            </tr>
            <tr>
              <td colspan="5">
                E por estar justo e contratado, as partes assinam o presente instrumento em 02 (duas) vias de igual teor de forma para que
                produza seus efeitos legais e jurídicos.
              </td>
            </tr>
            <tr>
              <td colspan="3" align="center"><br><br><br>____________________________________________________</td>
              <td colspan="2" align="center"><br><br><br>____________________________________________________</td>
            </tr>
            <tr>
              <td colspan="3" align="center">
                {{ $config->razao_social }}
              </td>
              <td colspan="2" align="center"> {{ $assinatura->user->name }} </td>
            </tr>
  
          </thead>
        </table>
      </div>
    </div>
  </body>
</html>