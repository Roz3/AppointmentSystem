@extends('layouts.studentLayout')

@section('content')
<div class="container">
<form class="flex items-center mr-4 mb-4" method="GET" action="{{ route('studentSearch') }}">
        <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
        <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
            <i class="fas fa-search"></i>
        </button>
      </form>
    <h5 class="text-2xl font-bold mb-6">Appointments</h5>
    
    @if (count($callslips) > 0)
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full border-collapse bg-gray-100">
                <thead>
                    <tr class="text-left bg-blue-600 text-white">
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400">No.</th>
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400">ID</th>
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400">From</th>
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400">Date Received</th>
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400">Status</th>
                        <th class="px-6 py-3 border-b-2 text-xs uppercase border-gray-400"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($callslips as $key=>$callslip)
                        <tr class="hover:bg-gray-200">
                            <td class="px-6 border-b-2 border-gray-300">{{ $key+1 }}</td>
                            <td class="px-6 border-b-2 border-gray-300">{{ $callslip->id }}</td>
                            <td class="px-6 border-b-2 border-gray-300">{{ $callslip->counselor_id ? App\Models\User::find($callslip->counselor_id)->name : '' }}</td>
                            <td class="px-6 border-b-2 border-gray-300">{{ $callslip->created_at->format('F j, Y g:i A') }}</td>
                            <td class="px-6 border-b-2 border-gray-300"
                                style="color:
                                @if($callslip->status == 'pending for counseling')
                                    green
                                @elseif($callslip->status == 'completed')
                                    blue
                                @elseif($callslip->status == 'cancelled')
                                    red
                                @endif">{{ $callslip->status }}</td>
                            <td class="px-6 border-b-2 border-gray-300">   
                                @if($callslip->status != 'completed')
                                    <button class="btn btn-primary view-callslip" data-id="{{ $callslip->id }}" data-toggle="modal" data-target="#callslipDetailsModal">
                                        View
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-6">
            <p>No callslips found.</p>
        </div>
    @endif
</div>
    @include('/student/view_callslip_modal')
    @include('/student/callslip_js')
    
@endsection
