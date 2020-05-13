<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Carnê</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    html,
    body {
      height: 100%;
    }
  
    body {
      background: #ddd;
      padding: 25px;
    }

    td {
      border: 1px solid #444444;
      padding: 0 3px;
      font-size: 13px
    }

    p, hr {
      margin: 0;
      padding: 0;
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
        margin: 0 auto;" id="buttons" class="mb-1">
        <div class="row">
          <div class="col-md-6"><button onclick="printFunction()" class="form-control btn btn-primary">Imprimir</button></div>
          <div class="col-md-6"><button onclick="window.location.href='/admin/carnes'" class="form-control btn btn-primary">Fechar</button></div>
        </div>      
        <br>
      </div>
      <div id="print" class="print" style="
      max-width: 794px; 
      height: 1123px;
      padding: 10px; 
      border: 2px solid #444444;
      margin: 0 auto; 
      background: #ffff;">

        <?php $count = 1; ?>
        @if(isset($_GET['capa']))
          
        <?php $count ++; ?>
          <div class="border p-2 pt-1" 
          style="
          margin-top: 0.5em;
          height: calc(1045px / 3);
          ">

          <table style="width: 100%; height: 100%" class="text-center">

            <tr>
              <td style="width: 25%; height: 100%">
                <h3>CARNÊ DE PAGAMENTO</h3>
                {{ $carne->user->name }}, CPF/CNPJ {{ $carne->user->cpf }} <br>
                {{ $carne->user->bairro }}, {{ $carne->user->city->nome }} <br>
                {{ $carne->user->state->nome }}
              </td>
              <td style="width: 25%">
                <h2 style="display: flex; flex-direction: column">
                  <div>
                    <?php
                    if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                      <img style="width: 240px; height: 240px;
                      object-fit: cover; display: inline" 
                      src="/uploads/config/{{ $config->logo }}" 
                      class="rounded" alt="{{ $config->name }}">
                  </div>
                  
                <?php endif; ?>
                <span class="">
                  {{ $config->name }}
                </span>
                </h2>
              </td>
            </tr>
          </table>
          </div>
        @endif

        @if(count($carnes))

          @foreach($carnes as $carne)
            @if($count % 3 != 1 || $count == 1)
              <div class="border p-2 pt-1" 
              style="
              margin-top: 0.5em;
              height: calc(1045px / 3);
              ">

              <table style="width: 100%">

                <tr>
                  <td style="width: 25%">
                    <?php
                    if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                      <img style="width: 40px; height: 40px;
                      object-fit: cover; " src="/uploads/config/{{ $config->logo }}" 
                      class="rounded" alt="{{ $config->name }}">
                    @else
                    {{ $config->name }}
                    <?php endif; ?>
                  </td>
                  <td>
                    <h2 style="display: flex; flex-direction: row"><?php
                      if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                        <img style="width: 40px; height: 40px;
                        object-fit: cover; display: inline" 
                        src="/uploads/config/{{ $config->logo }}" 
                        class="rounded" alt="{{ $config->name }}">
                      <?php endif; ?>
                      <span class="mt-1">
                        {{ $config->name }}
                      </span>
                      </h2>
                      
                  </td>
                  <td style="width: 25%">
                    <?php
                    if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                      <img style="width: 40px; height: 40px;
                      object-fit: cover; " src="/uploads/config/{{ $config->logo }}" 
                      class="rounded" alt="{{ $config->name }}">
                    @else
                    {{ $config->name }}
                    <?php endif; ?>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Vencimento</b> <br>
                    {{ dateFormat($carne->vencimento) }}
                  </td>
                  <td>
                    <b>LOCAL DE PAGAMENTO</b>
                    {{ $config->name }}
                  </td>
                  <td style="width: 25%">
                    <b>Vencimento</b> <br>
                    {{ dateFormat($carne->vencimento) }}
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Valor de Documento</b> <br>
                    {{ currencyFormat($carne->valor) }} 
                  </td>
                  <td>
                    <b>NOME DO CEDENTE</b>
                    {{ $config->name }}
                  </td>
                  <td style="width: 25%">
                    <b>Valor de Documento</b> <br>
                    {{ currencyFormat($carne->valor) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Parcela {{ $count.' / '.count($carnes) }}  </b>
                  </td>
                  <td style="font-size: 10px " rowspan="2">
                    INSTRUÇÕES <br>
                    Após {{ $config->dias_atraso }} dias de atraso, haverá o bloqueio dos serviços de Internet.
                    O desbloqueio só será realizado após o  pagamento dos débitos pendentes.
                    <br>
                    Após O vencimento será cobrada multa {{ currencyFormat($config->logo) }} e $R00 mora/dia.
                  </td>
                  <td style="width: 25%">
                    <b>Parcela {{ $count.' / '.count($carnes) }}  </b>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Desconto</b> 
                    {{ currencyFormat($carne->assinatura->desconto) }}
                  </td>
                  <td style="width: 25%">
                    <b>Desconto</b> 
                    {{ currencyFormat($carne->assinatura->desconto) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Acréscimo</b> 
                    {{ currencyFormat($carne->assinatura->acrescimo) }} 
                  </td>
                  <td></td>
                  <td style="width: 25%">
                    <b>Acréscimo</b> 
                    {{ currencyFormat($carne->assinatura->acrescimo) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Valor Pago</b> 
                  </td>
                  <td></td>
                  <td style="width: 25%">
                    <b>Valor Pago</b>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    Visto do Operador <br>
                    <b>Recebido em <br> __/__/____ </b>
                  </td>
                  <td>
                    <b>PAGADOR</b> <br>
                    {{ $carne->user->name }}, CPF/CNPJ {{ $carne->user->cpf }} <br>
                    {{ $carne->user->bairro }}, {{ $carne->user->city->nome }} <br>
                    {{ $carne->user->state->nome }}
                  </td>
                  <td style="width: 25%">
                    Visto do Operador <br>
                    <b>Recebido em <br> __/__/____ </b>
                  </td>
                </tr>

              </table>
              </div>
            @elseif($count % 3 == 1)
              </div>

              <div id="print" class=" print" style="
              max-width: 794px; 
              height: 1123px;
              padding: 10px; 
              border: 2px solid #444444;
              margin: 0 auto; 
              background: #ffff;">

              <div class="border p-2 " 
              style="
              height: calc(1045px / 3);
              ">
                  
              <table style="width: 100%">

                <tr>
                  <td style="width: 25%">
                    <?php
                    if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                      <img style="width: 40px; height: 40px;
                      object-fit: cover; " src="/uploads/config/{{ $config->logo }}" 
                      class="rounded" alt="{{ $config->name }}">
                    @else
                    {{ $config->name }}
                    <?php endif; ?>
                  </td>
                  <td>
                    <h2 style="display: flex; flex-direction: row"><?php
                      if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                        <img style="width: 40px; height: 40px;
                        object-fit: cover; display: inline" 
                        src="/uploads/config/{{ $config->logo }}" 
                        class="rounded" alt="{{ $config->name }}">
                      <?php endif; ?>
                      <span class="mt-1">
                        {{ $config->name }}
                      </span>
                      </h2>
                      
                  </td>
                  <td style="width: 25%">
                    <?php
                    if(!null == $config->logo && file_exists('uploads/config/'.$config->logo)): ?>
                      <img style="width: 40px; height: 40px;
                      object-fit: cover; " src="/uploads/config/{{ $config->logo }}" 
                      class="rounded" alt="{{ $config->name }}">
                    @else
                    {{ $config->name }}
                    <?php endif; ?>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Vencimento</b> <br>
                    {{ dateFormat($carne->vencimento) }}
                  </td>
                  <td>
                    <b>LOCAL DE PAGAMENTO</b>
                    {{ $config->name }}
                  </td>
                  <td style="width: 25%">
                    <b>Vencimento</b> <br>
                    {{ dateFormat($carne->vencimento) }}
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Valor de Documento</b> <br>
                    {{ currencyFormat($carne->valor) }} 
                  </td>
                  <td>
                    <b>NOME DO CEDENTE</b>
                    {{ $config->name }}
                  </td>
                  <td style="width: 25%">
                    <b>Valor de Documento</b> <br>
                    {{ currencyFormat($carne->valor) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Parcela {{ $count.' / '.count($carnes) }}  </b>
                  </td>
                  <td style="font-size: 10px " rowspan="2">
                    INSTRUÇÕES <br>
                    Após 8 dias de atraso, haverá o bloqueio dos serviços de Internet.
                    O desbloqueio só será realizado após o  pagamento dos débitos pendentes.
                    <br>
                    Após O vencimento será cobrada multa R$12.00 e $R mora/dia.
                  </td>
                  <td style="width: 25%">
                    <b>Parcela {{ $count.' / '.count($carnes) }}  </b>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Desconto</b> 
                    {{ currencyFormat($carne->assinatura->desconto) }}
                  </td>
                  <td style="width: 25%">
                    <b>Desconto</b> 
                    {{ currencyFormat($carne->assinatura->desconto) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Acréscimo</b> 
                    {{ currencyFormat($carne->assinatura->acrescimo) }} 
                  </td>
                  <td></td>
                  <td style="width: 25%">
                    <b>Acréscimo</b> 
                    {{ currencyFormat($carne->assinatura->acrescimo) }} 
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    <b>Valor Pago</b> 
                  </td>
                  <td></td>
                  <td style="width: 25%">
                    <b>Valor Pago</b>
                  </td>
                </tr>

                <tr>
                  <td style="width: 25%">
                    Visto do Operador <br>
                    <b>Recebido em <br> __/__/____ </b>
                  </td>
                  <td>
                    <b>PAGADOR</b> <br>
                    {{ $carne->user->name }}, CPF/CNPJ {{ $carne->user->cpf }} <br>
                    {{ $carne->user->bairro }}, {{ $carne->user->city->nome }} <br>
                    {{ $carne->user->state->nome }}
                  </td>
                  <td style="width: 25%">
                    Visto do Operador <br>
                    <b>Recebido em <br> __/__/____ </b>
                  </td>
                </tr>

              </table>

              </div>
            @endif
            <?php $count ++; ?>
        @endforeach
        @endif
        <br>
      </div>
      <br><br>
    </div>
  </body>
</html>