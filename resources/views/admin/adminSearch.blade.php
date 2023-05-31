@extends('layouts.adminLayout')

@section('content')
<h5>Search Results for "{{ $query }}"</h5>

@if ($results1->count() > 0)
    <table class="table table-bordered table-striped blur-sides shadow">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results1 as $result)
                <tr>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if ($results2->count() > 0)
    <table class="table table-bordered table-striped blur-sides shadow">
        <thead>
            <tr>
                <th>Reason</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results2 as $result)
                <tr>
                    <td>{{ $result->reason }}</td>
                    <td>{{ $result->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if ($results3->count() > 0)
    <table class="table table-bordered table-striped blur-sides shadow">
        <thead>
            <tr>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results3 as $result)
                <tr>
                    <td>{{ $result->course }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if ($results4->count() > 0)
    <table class="table table-bordered table-striped blur-sides shadow">
        <thead>
            <tr>
                <th>College</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results4 as $result)
                <tr>
                    <td>{{ $result->department }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if ($results1->count() == 0 && $results2->count() == 0 && $results3->count() == 0  && $results4->count() == 0)
    <p>No results found</p>
@endif

@endsection
