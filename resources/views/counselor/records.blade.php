@extends('layouts.cLayout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-4">
        <form class="flex items-center" method="GET" action="{{ route('counselorSearch') }}">
            <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
            <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
   
    
        <div class="flex justify-center mb-4">
            <a href="{{ route('counselor.records', ['type' => 'callslips']) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded no-underline">
                Callslips
            </a>
            <a href="{{ route('counselor.records', ['type' => 'referrals']) }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded no-underline">
                Referrals
            </a>
        </div>

    @if($type == 'callslips')
    <h2 class="text-xl font-bold mb-2 text-center">Callslip records</h2>
    @if(count($callslips) > 0)
    <table class="min-w-full divide-y divide-gray-200 border-gray-200 shadow">
        <thead>
            <tr class="bg-blue-600 text-white">
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">No.</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Student Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($callslips as $key=>$callslip)
                @if ($callslip->status == 'completed')
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $key+1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ App\Models\User::find($callslip->student_id)->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ date('m/d/y', strtotime($callslip->date)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ date('h:i A', strtotime($callslip->time)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap" style="color: blue"> {{ $callslip->status}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex">
                        <form action="{{ route('counselor.view-callslip', ['id' => $callslip->id]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mr-2">View</button>
                                </form>

                        <a href="" 
                            class="btn btn-danger delete_callslip"
                            data-id="{{ $callslip->id }}"
                        >
                      Delete
                        </a>
                        </div>
                    </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @else
        <p>No callslip records found.</p>
    @endif
@elseif($type == 'referrals')
    <h2 class="text-xl font-bold mb-2  text-center">Referral Records</h2>
    @if(count($referrals) > 0)
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr class="bg-blue-600 text-white">
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">No.</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Referred  by</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Student Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Reason for Referral</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($referrals as $key=>$referral)
                @if ($referral->status == 'done')
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $key+1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ App\Models\User::find($referral->instructor_id)->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ App\Models\User::find($referral->student_id)->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $reason = App\Models\Reason::find($referral->reason_id);
                                @endphp
                                @if ($reason)
                                    {{ $reason->reason }}
                                @else
                                    N/A
                                @endif
                            </td>

                        <td class="px-6 py-4 whitespace-nowrap" style="color: blue"> {{ $referral->status}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex">
                        <form action="{{ route('counselor.view-referral', ['id' => $referral->id]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mr-2">View</button>
                                </form>

                                <a href="" 
                                        class="btn btn-danger delete_referral"
                                        data-id="{{ $referral->id }}">
                                        Delete
                                    </a>
                        </div>
                    </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @else
        <p>No referral records found.</p>
    @endif
@endif

</div>
@include('/counselor/callslip_js')
@include('/counselor/referral_js')
@endsection
