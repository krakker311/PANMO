<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/"><img style="width:100px;height:40px;" src="{{ asset('img/2.png') }}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ $active === "home" ? 'active' :'' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === "about" ? 'active' :'' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === "posts" ? 'active' :'' }}" href="/posts">Browse</a>
          </li>
          @if (Auth::check())
            @if(Auth::User()->role_id == 1)
            <li class="nav-item">
              <a class="nav-link {{ $active === "favorite" ? 'active' :'' }}" href="/favorites">Favorite List</a>
            </li>
            @endif
          @endif           
        </ul>
        
        <ul class="navbar-nav ms-auto">
                @auth
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown">
                      Welcome Back, {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i> My dashboard</a>
                      <div class="dropdown-divider"></div>
                        <form action="/logout" method="post">
                          @csrf
                          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </div>
                  </li>
                    @else
                      <li class="nav-item">
                        <a href="/login" class="nav-link {{ $active === "login" ? 'active' :'' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                      </li>
                @endauth
        </ul>
      </div>
    </div>
  </nav>