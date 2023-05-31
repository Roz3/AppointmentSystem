@extends('layouts.insLayout')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-xl mb-4"><i class="fas fa-user-circle"></i> My Profile</h4>
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">Name:</td>
                    <td>{{ $instructor->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Barangay:</td>
                    <td>{{ $instructor->barangay }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Municipal:</td>
                    <td>{{ $instructor->municipal }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Province:</td>
                    <td>{{ $instructor->province }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Contact Number:</td>
                    <td>{{ $instructor->contact }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Email:</td>
                    <td>{{ $instructor->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Password:</td>
                    <td>{{ $instructor->password }}</td>
                </tr>

            </tbody>
        </table>
        <a href="{{ route('instructor.editProfile', $instructor->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
    </div>
@endsection
