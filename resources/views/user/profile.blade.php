@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - Meus Perfil')

@section('content')
<div class="container pb-4" style="background: #ddd">
    
    <?php
    if(!null == Auth::user()->avatar && file_exists('uploads/avatar/'.Auth::user()->avatar)): 
        $image = "/uploads/avatar/{{ Auth::user()->avatar }}";
    else: 
        $image = "/images/person.png";
    endif; ?>
    <div class="row pt-4" 
    style="display: flex; 
    align-items: center; 
    background-image: url({{ (!null == Auth::user()->avatar) ? 'uploads/avatar/'.Auth::user()->avatar : 'images/back.jpg' }});
    background-position: right;
    background-repeat: no-repeat;
    background-size:cover;
    background-position: center;
    justify-content: center">
        <div class="col-sm-3 text-center">
            <?php
            if(!null == Auth::user()->avatar && file_exists('uploads/avatar/'.Auth::user()->avatar)): ?>
                <img style="width: 110px; height: 110px;
                border: 6px solid #444; 
                object-fit: cover; " src="uploads/avatar/{{ Auth::user()->avatar }}" 
                class="rounded mb-4" alt="...">
            <?php else: ?>
                <img style="width: 110px; height: 110px;;" src="/images/person.png" 
                class="rounded mb-4 border" alt="...">
            <?php endif; ?>
        </div>
        <!--<div class="col-sm-9 text-center mx-4 py-3 mb-4" 
        style="background: rgba(0, 0, 0, 0.5)">
            <h3 class="text-light">Meu Perfil</h3>
            <a href="/profile/photo" class="text-light">Alterar Foto de Perfil</a> <br>
            <a href="/my-purchases" 
            class="text-light">Meus Pedidos de Compra</a> <br>
        </div>-->
    </div>
    
    @if(Session::has('success'))
        <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
    @elseif(Session::has('warning'))
        <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
    @endif
    <div class="p-4">
        <table class="mt-4 table border table-striped bg-white">
        <tr>
            <td style="width: 70px">Nome</td> 
            <td>{{ firstLeterToUpper(Auth::user()->name)  }}</td>            
        </tr>
        <tr>
            <td colspan="2">{{ Auth::user()->email }}</td>            
        </tr>
        <tr>
            <td>Usuário</td> 
            <td>{{ '@'.Auth::user()->username }}</td>            
        </tr>
        <tr>
            <td>Telefone</td> 
            <td>{{ (!empty(Auth::user()->phone)) ? Auth::user()->phone : 'Sem Telefone' }}</td>            
        </tr>
        <tr>
            <td>Gênero</td> 
            <td>{{ (!empty(Auth::user()->gender)) ? gender(Auth::user()->gender) : 'Sem gênero' }}</td>            
        </tr>
        <tr>
            <td>Aniversário</td> 
            <td>{{ (!empty(Auth::user()->birth_day)) ? dateFormat(Auth::user()->birth_day) : 'Sem Data de Aniversário' }}</td>            
        </tr>
        <tr>
            <td>Cidade</td> 
            <td>
                {{ (!empty(Auth::user()->state->nome)) ? 
                    Auth::user()->state->nome : 'Sem Cidade' }}
            </td>            
        </tr>
        <tr>
            <td>Nível</td> 
            <td>{{ (!empty(Auth::user()->role)) ? userLevel(Auth::user()->role) : 'Sem imagem' }}</td>            
        </tr>
    </table>
    </div>
    
    <div class="row">
        <!--<div class="col-sm-12 text-center">
        <a href="/profile/edit">Editar Perfil</a> <br>
        <a class="btn text-white bg-primary mt-3" 
        data-toggle="modal"
        data-target="#exampleModalCenter">
            Editar Senha
        </a>-->

        <a class="nav-link active" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Sair') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </div>
</div>





<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
        <form action="/profile/change-password" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alterar senha</h5>
       
    </div>
    <div class="modal-body">
        
            @csrf
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" 
                aria-describedby="pwHelp" placeholder="Digite a senha actual">
                <small id="pwHelp" 
                class="form-text text-muted">
                    Introduza a senha actual da sua conta
                </small>
              </div>

              <div class="form-group">
                <input type="password" class="form-control" id="npassword"
                name="npassword" 
                aria-describedby="npwHelp" placeholder="Nova senha">
                <small id="npwHelp" 
                class="form-text text-muted">
                    Introduza a nova senha
                </small>
              </div>

              <div class="form-group">
                <input type="password" name="cpassword" class="form-control" id="cpassword" 
                aria-describedby="cpwHelp" placeholder="Confirmar Nova Senha">
                <small id="cpwHelp" 
                class="form-text text-muted">
                    Confirme a nova senha
                </small>
              </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit"  class="btn btn-primary">Salvar</button>
    </div>
</form>
    </div>

</div>
</div>



@endsection
