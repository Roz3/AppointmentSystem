@extends('layouts.cLayout')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-xl mb-4"><i class="fas fa-user-circle"></i> My Profile</h4>
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">Name:</td>
                    <td>{{ $counselor->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Barangay:</td>
                    <td>{{ $counselor->barangay }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Municipal:</td>
                    <td>{{ $counselor->municipal }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Province:</td>
                    <td>{{ $counselor->province }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Contact Number:</td>
                    <td>{{ $counselor->contact }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Email:</td>
                    <td>{{ $counselor->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Password:</td>
                    <td>{{ $counselor->password }}</td>
                </tr>

            </tbody>
        </table>
        <a href="{{ route('counselor.editProfile', $counselor->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
    </div>
@endsection
