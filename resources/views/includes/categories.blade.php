<nav class="navbar navbar-expand-lg fixed-bottom navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="#">Categorias:</a>
    
    <button class="navbar-toggler" 
    style="padding: 0; border: 0" 
    type="button" 
    data-toggle="collapse" 
    data-target="#navbarNavDropdown" 
    aria-expanded="false" 
    aria-label="{{ __('Toggle navigation') }}">
        <i class="fa fa-bars"></i> 
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        @foreach($categories as $cat)
            @if(count($cat->subcategories) == 0)
            <li class="nav-item active">
            <a class="nav-link" href="/category/{{ $cat->slug }}"> {{ $cat->name }} </a>
            </li>
            @else
                <li class="nav-item dropup">
                    <a class="nav-link dropdown-toggle" 
                    href="#" id="cat{{ $cat->id }}" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false">
                        {{ $cat->name }} 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="cat{{ $cat->id }}">
                        <a class="dropdown-item" href="/category/{{ $cat->slug }}"> {{ $cat->name }}</a>
                        <div class="dropdown-divider"></div>
                        @foreach($cat->subcategories as $sub)
                            <a class="dropdown-item" href="/subcategory/{{ $sub->slug }}"> {{ $sub->name }}</a>
                        @endforeach
                    </div>
                </li>
            @endif

        @endforeach
      </ul>
    </div>
</div>
</nav>