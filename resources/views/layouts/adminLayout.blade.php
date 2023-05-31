<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
    
    <script type="text/javascript" src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
      // Add an event listener to the sidebar and navbar links
$(".sidebar-link, .navbar-nav a").click(function(event) {
  // Prevent the default link behavior
  event.preventDefault();
  // Get the href attribute of the clicked link
  var url = $(this).attr("href");
  // Send an AJAX request to the server to fetch the content of the corresponding page
  $.get(url, function(data) {
    // Replace the current page's main content with the fetched content
    $(".main-content").html($(data).find(".main-content").html());
  });
});

      </script>
      
</head>
<body>

<header class="navbar bg-gradient-to-l from-blue-700 via-white to-blue-700">
  <nav class="navbar-nav navbar-right">
    <ul>
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center text-white hover:text-white-200 hover:shadow-lg">
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
  <div class="sidebar bg-gradient-to-br from-blue-700 via-white to-blue-700">
     <!--profile image & text-->
  <div class="profile">
      <img src="{{ asset('assets/pictures/logo.png') }}" alt="profile_picture">
      <h5>GUIDANCE OFFICE </h5>
      <p>Welcome, {{ auth()->user()->name }}!</p>
  </div>

  <!--menu item-->
  <ul>
      
      <li>
          <a href="/admin/dashboard" class="flex items-center px-4 py-2 text-gray-600 hover:text-white hover:bg-gray-600">
              <span class="icon mr-3"><i class="fas fa-desktop"></i></span>
              <span class="item">Dashboard</span>
          </a>
      </li>


    
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="dropdown-toggle flex items-center px-4 py-2 text-gray-600" href="" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="icon mr-3"><i class="fa fa-users"></i></span> <span class="item">Management</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/admin/users">Users</a></li>
          <li><a class="dropdown-item" href="/admin/departments">Colleges</a></li>
          <li><a class="dropdown-item" href="/admin/courses">Courses</a></li>
          <li><a class="dropdown-item" href="/admin/reasons">Reasons</a></li>
        </ul>
      </li>
     
      <li>
          <a href="/admin/profile" class="flex items-center px-4 py-2 text-gray-600 hover:text-white hover:bg-gray-600">
                <span class="icon mr-3"><i class="fas fa-user"></i></span>
                    <span class="item">My Account</span>
          </a>
    </li>
</div>
<div class="main-content bg-gray-200" style="min-height: 100vh;">
    <!-- child view content will be inserted here -->
    @yield('content')
</div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>


</html>