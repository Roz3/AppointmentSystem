@extends('layouts.cLayout')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
<h1 class="text-2xl font-bold mb-4">Referral Details</h1>
<table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">DATE:</td>
                    <td> {{ date('m/d/y', strtotime($referral->created_at)) }}</td>
                </tr>

                <tr>
                    <td class="font-bold">NAME OF STUDENT:</td>
                    <td> {{ App\Models\User::find($referral->student_id)->name }}</td>
                </tr>

                <tr>
                    <td class="font-bold">DETAILS:</td>
                    <td> {{ $referral->referral_details }}</td>
                </tr>

                <tr>
                    <td class="font-bold">PREVIOUS INTERVENTIONS:</td>
                    <td> {{ $referral->referral_previous_interventions }}</td>
                </tr>

                <tr>
                    <td class="font-bold">REASON FOR REFERRAL:</td>
                    <td> {{ $referral->reason_id ? App\Models\Reason::find($referral->reason_id)->reason : '' }}</td>    
                </tr>

                <tr>        
                    <td class="font-bold">BEST TIME TO MEET THE STUDENT</td>
                </tr>

                <tr>
                    <td class="font-bold">First Choice:
                    <td> {{ \Carbon\Carbon::parse($referral->first_choice)->isoFormat('LL LT') }}</td>
                 </tr>

                <tr>
                    <td class="font-bold">Second Choice:
                    <td> {{ \Carbon\Carbon::parse($referral->second_choice)->isoFormat('LL LT') }}</td>
                </tr>

                <tr>   
                    <td class="font-bold">NAME OF COUNSELOR:
                    <td> {{  App\Models\User::find($referral->counselor_id)->name }}</td>
                </tr>
        </tbody>
    </table>
    <a href="{{ route('counselor.referrals') }}" class="inline-block py-2 px-4 bg-gray-300 hover:bg-gray-400 rounded-lg text-black font-bold no-underline">Back to Referrals</a>
    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded no-underline" data-bs-toggle="modal" data-bs-target="#addModal" data-student-name="{{ App\Models\User::find($referral->student_id)->name }}" data-instructor-name="{{ App\Models\User::find($referral->instructor_id)->name }}">Create Call Slip</button>
</div>    
@include('/counselor/add_callslip_modal')
@include('/counselor/callslip_js')
@endsection