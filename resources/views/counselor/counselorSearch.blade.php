@extends('layouts.cLayout')

@section('content')
<h5>Search Results for "{{ $query }}"</h5>

@if ($results1->count() > 0)
    <h6>Users</h6>
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
@endsection