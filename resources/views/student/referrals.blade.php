@extends('layouts.studentLayout')

@section('content')

<div class="container">
<div class="container mt-3">
<div class="flex justify-between items-center mb-3">
  
</div>
      <form class="flex items-center mr-4" method="GET" action="{{ route('studentSearch') }}">
        <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
        <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
            <i class="fas fa-search"></i>
        </button>
      </form>

      <a href="" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#addReferralModal">
        <i class="fas fa-plus mr-2"></i>Referral
      </a>
   
      <div class="table-data">
      @if(count($referrals) > 0)
                <table class="table-auto w-full border border-collapse border-gray-200 shadow">
  <thead>
          <tr class="bg-blue-600 text-white">
            <th scope="col" class="px-4 py-2">No.</th>
            <th scope="col" class="px-4 py-2">Student Name</th>
            <th scope="col" class="px-4 py-2">Reason for Referral</th>
            <th scope="col" class="px-4 py-2">Date</th>
            <th scope="col" class="px-4 py-2">Status</th>
            <th scope="col" class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($referrals as $key=>$referral)
    
        <tr class="hover:bg-gray-200">
            <td class="border px-4 py-2">{{ $key+1 }}</td>
            <td class="border px-4 py-2">{{ App\Models\User::find($referral->student_id)->name }}</td>
            <td class="border px-4 py-2">{{ $referral->reason_id ? App\Models\Reason::find($referral->reason_id)->reason : '' }}</td>
            <td class="border px-4 py-2">{{  date('m/d/y', strtotime($referral->created_at)) }}</td>
            <td class="border px-4 py-2" style="color:
                    @if($referral->status == 'pending')
                        green
                    @elseif($referral->status == 'done')
                        blue
                    @endif">
                    {{ $referral->status}}
                </td>
            <td class="border px-4 py-2">
            <a href="{{ route('student.view_referral', ['id' => $referral->id]) }}" class="inline-block py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-bold">View</a>
            </td>
        </tr>
   
@endforeach

</tbody>

      </table>
      @else
    <p>You have no referrals.</p>
@endif
{{ $referrals->links('custom-pagination') }}
    </div>
  </div>


@include('/student/add_referral_modal')
@include('/student/referral_js')


@endsection
