@extends('layouts.adminLayout')

@section('content')


<div class="container mt-3">
    <h5 class="text-lg font-semibold">Dashboard</h5>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <a href="{{ route('admin.users') }}" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Total Users</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-green-500"></i> {{ $userTypeCounts[0] + $userTypeCounts[1] + $userTypeCounts[2] + $userTypeCounts[3] }}</h4>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.studentlist') }}" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Students</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-blue-500"></i> {{ $userTypeCounts[0] }}</h4>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.instructorlist') }}" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Instructors</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-red-500"></i> {{ $userTypeCounts[1] }}</h4>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.counselorlist') }}" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Counselors</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-yellow-500"></i> {{ $userTypeCounts[2] }}</h4>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.adminlist') }}" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Admin</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-green-500"></i> {{ $userTypeCounts[3] }}</h4>
                </div>
            </div>
        </a>

        <a href="/admin/departments" class="no-underline">
        <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Colleges</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-blue-500"></i> {{ $collegesCount }}</h4>
                </div>
            </div>

        <a href="/admin/courses" class="no-underline">
        <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Courses</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-blue-500"></i> {{ $coursesCount }}</h4>
                </div>
            </div>

            <a href="/admin/reasons" class="no-underline">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="text-black">
                    <h5 class="text-sm font-semibold uppercase">Reasons for Referral</h5>
                    <h4 class="text-3xl"><i class="fas fa-chart-bar text-blue-500"></i> {{ $reasonsCount }}</h4>
                </div>
            </div>

    </div>
    <div id="userTypeChart" style="width: 100%; height: 400px; margin-top: 15px;"></div>
</div>
<script type="text/javascript">
  // Load the Visualization API and the corechart package
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded
  google.charts.setOnLoadCallback(drawChart);

  // Create the chart and draw it
  function drawChart() {
    // Define the data for the chart
    var data = google.visualization.arrayToDataTable([
      ['User Type', 'Number of Users'],
      ['Students', {{$userTypeCounts[0]}}],
      ['Instructors', {{$userTypeCounts[1]}}],
      ['Counselors', {{$userTypeCounts[2]}}],
      ['Admins', {{$userTypeCounts[3]}}]
    ]);

    // Define the options for the chart
    var options = {
      title: 'Users',
      is3D: true,
      pieHole: 0.4
    };

    // Create the chart object and draw it
    var chart = new google.visualization.PieChart(document.getElementById('userTypeChart'));
    chart.draw(data, options);
  }
</script>




@endsection
