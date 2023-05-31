@extends('layouts.cLayout')

@section('content')
<button type="button" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded no-underline mb-6" data-bs-toggle="modal" data-bs-target="#addAvailabilityModal" > <i class="fas fa-plus mr-2"></i>Add Availability</button>

<div class="p-4 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">My Availabilities</h1>
    @if(count($availabilities) > 0)
    <table class="w-full table-auto border rounded">
        <thead>
            <tr>
                <th class="px-4 py-2 font-semibold text-left border">Date</th>
                <th class="px-4 py-2 font-semibold text-left border">Start Time</th>
                <th class="px-4 py-2 font-semibold text-left border">End Time</th>
                <th class="px-4 py-2 font-semibold text-left border">Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($availabilities as $availability)
            <tr>
                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($availability->date)->format('l, F jS Y') }}</td>
                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}</td>
                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}</td>
                <td class="px-4 py-2 border">
                        <a href="" 
                            class="btn btn-danger delete_availability"
                            data-id="{{ $availability->id }}"
                        >
                        Delete
                        </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No availabilities found.</p>
    @endif
</div>
@include('/counselor/add_availability_modal')
@include('/counselor/availability_js')
@endsection
