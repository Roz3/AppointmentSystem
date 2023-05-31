<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/instructor.css') }}" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/loader.js') }}"></script>
</head>
<body>

<header class="navbar">
  
  <nav class="navbar-nav navbar-right">
    <ul>
      <li>
        <a href="{{ route('instructor.notifications') }}">
          <span class="icon mr-3"><i class="fas fa-bell"></i></span>
          <span class="item">Notifications</span>
          @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-pill bg-red-600 text-white ml-auto">{{ auth()->user()->unreadNotifications->count() }}</span>
          @endif
        </a>
      </li>
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="item-icon"><i class="fas fa-sign-out-alt me-2"></i></span>
          <span class="item-logout">{{ __('Logout') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </nav>
</header>




    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">

           <!--profile image & text-->
           <div class="profile">
              <img src="{{ asset('assets/pictures/logo.png') }}" alt="profile_picture">
              <h5>GUIDANCE OFFICE </h5>
                <p>Welcome, {{ auth()->user()->name }}!</p>
          </div>

            <!--menu item-->
            <ul>
              
            <li>
                    <a href="/instructor/dashboard">
                        <span class="icon mr-3"><i class="fas fa-desktop"></i></span>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
               
                <li>
                    <a href="/instructor/referrals">
                        <span class="icon mr-3"><i class="fas fa-users"></i></span>
                        <span class="item">Referrals</span>
                    </a>
                </li>

               
               
                <li>
                    <a href="/instructor/profile">
                        <span class="icon mr-3"><i class="fas fa-user"></i></span>
                        <span class="item">My Account</span>
                    </a>
                </li>


               

            </ul>
        </div>
        </div>

    </div>
    
    <div class="main-content bg-gray-200" style="min-height: 100vh;">
    <!-- child view content will be inserted here -->
    @yield('content')
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>