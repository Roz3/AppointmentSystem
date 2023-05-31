@extends('layouts.cLayout')

@section('content')

<div class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
        <form class="flex items-center mb-4" method="GET" action="{{ route('counselorSearch') }}">
            <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
            <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
            <div class="bg-white shadow-lg rounded-lg px-4 py-4">
                
                <h1 class="text-2xl font-bold mb-4">Referrals</h1>
                @if(count($referrals) > 0)
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Name of Student</th>
                            <th class="px-4 py-2">Referred by</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $key=>$referral)
                        @if($referral->status == 'done')
                            @continue
                        @endif
                        <tr>
                            <td class="border px-4 py-2">{{ $key+1 }}</td>
                            <td class="border px-4 py-2">{{ App\Models\User::find($referral->student_id)->name }}</td>
                            <td class="border px-4 py-2">{{ App\Models\User::find($referral->instructor_id)->name }}</td>
                            <td class="border px-4 py-2">{{ date('m/d/y', strtotime($referral->created_at)) }}</td>
                            <td class="border px-4 py-2" style="color:
                                @if($referral->status == 'pending')
                                    green
                                @elseif($referral->status == 'done')
                                    blue
                                @endif"> {{ $referral->status}} </td>
                               
                            <td class="border px-4 py-2">
                            <div class="flex">
                               <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-2 rounded no-underline mr-2 approve-referral-btn " data-id="{{ $referral->id }}">
                                    Approve
                                </button>

                                <form action="{{ route('counselor.view_referral', ['id' => $referral->id]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-2 rounded no-underline mr-2">View</button>
                                </form>


                                <a href="" 
                                        class="btn btn-danger delete_referral"
                                        data-id="{{ $referral->id }}">
                                    Delete
                                    </a>
                            </td>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                {{ $referrals->links('custom-pagination') }}
                </div>

                @else
                <p>No referrals found.</p>
                @endif

            </div>
        </div>
    </div>
</div>
@include('/counselor/view_referral_modal')
@include('/counselor/referral_js')
@endsection
