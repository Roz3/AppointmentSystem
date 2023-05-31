@extends('layouts.cLayout')

@section('content')
<form method="GET" action="{{ route('counselor.generateReport') }}">
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" class="form-control" id="start_date" name="start_date">
    </div>

    <div class="form-group">
        <label for="end_date">End Date:</label>
        <input type="date" class="form-control" id="end_date" name="end_date">
    </div>

    <button type="submit" class="btn btn-primary">Generate Report</button>
</form>

@endsection