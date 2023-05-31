@extends('layouts.cLayout')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
<h1 class="text-2xl font-bold mb-4">Callslip Details</h1>
<table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">DATE:</td>
                    <td> {{ date('m/d/y', strtotime($callslip->created_at)) }}</td>
                </tr>

                <tr>
                    <td class="font-bold">TIME:
                    <td> {{ \Carbon\Carbon::parse($callslip->time)->isoFormat('LT') }}</td>
                 </tr>

                <tr>
                    <td class="font-bold">NAME OF STUDENT:</td>
                    <td> {{ App\Models\User::find($callslip->student_id)->name }}</td>
                </tr>

                <tr>
                    <td class="font-bold">EMAIL:</td>
                    <td> {{ App\Models\User::find($callslip->student_id)->email }}</td>
                </tr>

                <tr>
                    <td class="font-bold">REFERRED BY:</td>
                    <td> {{ App\Models\User::find($callslip->instructor_id)->name }}</td>
                </tr>

                <tr>
                    <td class="font-bold">EMAIL:</td>
                    <td> {{ App\Models\User::find($callslip->instructor_id)->email }}</td>
                </tr>

                <tr>   
                    <td class="font-bold">NAME OF COUNSELOR:
                    <td> {{  App\Models\User::find($callslip->counselor_id)->name }}</td>
                </tr>

                <tr>   
                    <td class="font-bold">STATUS:
                    <td class="{{ $callslip->status === 'completed' ? 'text-green-500 font-bold' : '' }}"> {{ $callslip->status }}</td>
                </tr>

        </tbody>
    </table>
    <a href="{{ route('counselor.records', ['type' => 'callslips']) }}" class="inline-block py-2 px-4 bg-gray-300 hover:bg-gray-400 rounded-lg text-black font-bold no-underline">Back to Records</a>

</div>    
@endsection


        