<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active">App Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.create') }}">Create a post</a>
            </li>
             @auth
       
          <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             {{ auth()->user()->name }}
             </a>
             <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                
           
                 <li class="nav-item">
                   <form action="{{ route('logout') }}" method="post">
                     @csrf
                    <button type="submit"> deconnexion</button></form>
                 
                 </li>
                            </ul>
           </li>
          @endauth 

        </ul>
    </div>
</nav>
