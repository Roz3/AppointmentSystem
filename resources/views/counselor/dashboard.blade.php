@extends('layouts.cLayout')

@section('content')

<div class="container mt-3 ">
    <h5 class="text-lg font-semibold">Dashboard</h5>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">

    <a href="/counselor/callslips" class="no-underline">
        <div class="bg-yellow-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Total Appointments</h5>
                <h4 class="text-3xl"><i class="far fa-chart-bar text-black-500"></i> {{ $pendingCount + $completedCount }}</h4>
            </div>
        </div>

        <a href="/counselor/callslips" class="no-underline">
        <div class="bg-red-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Pending Appointments</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $pendingCount }}</h4>
            </div>
        </div>

        <a href="/counselor/callslips" class="no-underline">
        <div class="bg-green-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Completed Appointments</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $completedCount }}</h4>
            </div>
        </div>

        <a href="/counselor/referrals" class="no-underline">
        <div class="bg-yellow-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Total Referrals Received</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $referralsReceived->count() }}</h4>
            </div>
        </div>

        <a href="/counselor/referrals" class="no-underline">
        <div class="bg-red-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Pending Referrals</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $pendingReferrals}}</h4>
            </div>
        </div>

        <a href="/counselor/referrals" class="no-underline">
        <div class="bg-green-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Approved Referrals</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $referralsApproved}}</h4>
            </div>
        </div>

        <a href="{{ route('counselor.studentslist') }}" class="no-underline">
        <div class="bg-blue-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Students</h5>
                <h4 class="text-3xl"><i class="fas fa-users text-black-500"></i> {{ $userTypeCounts[0] }}</h4>
            </div>
        </div>

        <a href="{{ route('counselor.instructorslist') }}" class="no-underline">
        <div class="bg-blue-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Instructors</h5>
                <h4 class="text-3xl"><i class="fas fa-users text-black-500"></i> {{ $userTypeCounts[1] }}</h4>
            </div>
        </div>
    </div>
    @if($upcomingAppointments->count() > 0)
    <div class="mt-8">
        <h5 class="text-lg font-semibold">Upcoming Appointments</h5>
        <div class="table-responsive mt-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="py-2">Date</th>
                        <th class="py-2">Time</th>
                        <th class="py-2">Student</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingAppointments as $callslip)
                        <tr>
                            <td class="py-2">{{ $callslip->date }}</td>
                            <td class="py-2">{{ $callslip->time }}</td>
                            <td class="py-2">{{ $callslip->student->name }}</td>
                            <td class="py-2">{{ $callslip->status }}</td>
                            <td class="py-2"><a href="{{ route('counselor.viewCallslip', $callslip->id) }}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
<div id="chart_div" style="width: 100%; height: 400px; margin-top: 15px;"></div>
</div>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Status', 'Count'],
      ['Pending Appointments', {{ $pendingCount }}],
      ['Completed Appointments', {{ $completedCount }}]
    ]);

    var options = {
    title: 'Appointment Status',
    colors: ['#FF0000', '#0000FF'],
    pieHole: 0.4
    };


    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

@endsection