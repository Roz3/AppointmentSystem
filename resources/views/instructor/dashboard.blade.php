@extends('layouts.insLayout')

@section('content')

<div class="container mt-3 ">
    <h5 class="text-lg font-semibold">Dashboard</h5>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">

        <a href="/instructor/referrals" class="no-underline">
        <div class="bg-yellow-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Total Referrals</h5>
                <h4 class="text-3xl"><i class="far fa-chart-bar text-black-500"></i> {{ $pendingReferral + $doneReferralCount }}</h4>
            </div>
        </div>

        <a href="/instructor/referrals" class="no-underline">
        <div class="bg-red-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Pending Referrals</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $pendingReferral }}</h4>
            </div>
        </div>

        <a href="/instructor/referrals" class="no-underline">
        <div class="bg-green-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Approved Referrals</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $doneReferralCount }}</h4>
            </div>
        </div>

        <a href="{{ route('instructor.studentslist') }}" class="no-underline">
        <div class="bg-blue-500 p-4 rounded-lg shadow-lg">
            <div class="text-black">
                <h5 class="text-sm font-semibold uppercase">Students</h5>
                <h4 class="text-3xl"><i class="fas fa-chart-bar text-black-500"></i> {{ $userTypeCounts[0] }}</h4>
            </div>
        </div>
</div>
        <div id="referralChart" style="width: 100%; height: 400px; margin-top: 15px;"></div>
</div>
<script type="text/javascript">
  
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
   
    var data = google.visualization.arrayToDataTable([
      ['Referrals', 'Number of Referrals'],
      ['Approved', {{$doneReferralCount}}],
      ['Pending', {{$pendingReferral}}],
    ]);

    var options = {
      title: 'Referral Status',
      is3D: true,
      colors: ['#00FF00', '#FF0000'],
      pieHole: 0.4
    };

    // Create the chart object and draw it
    var chart = new google.visualization.PieChart(document.getElementById('referralChart'));
    chart.draw(data, options);
  }
</script>

@endsection