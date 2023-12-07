<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="/"> <img src="{{ asset('/img/Poké_Ball_icon.svg.png') }}" alt="" srcset="" height="30" width="30"> Pokedex </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
       <li class="nav-item active">
        <a class="nav-link" href="/users/list">Users<span class="sr-only">(current)</span></a>
       </li>
    </ul>

    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ asset('/img/default_user.png') }}" alt="" srcset="" height="30" width="30" style="border-radius: 50px;"> {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/user/profile"><span class="fa fa-user"></span>Profile</a>
          <a class="dropdown-item" href="/logout"><span class="fa fa-arrow-right"></span>Logout</a>
        </div>
    </div>
  </div>
</nav>