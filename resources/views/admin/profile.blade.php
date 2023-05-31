@extends('layouts.adminLayout')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-xl mb-4"><i class="fas fa-user-circle"></i> My Profile</h4>
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">Name:</td>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Barangay:</td>
                    <td>{{ $admin->barangay }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Municipal:</td>
                    <td>{{ $admin->municipal }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Province:</td>
                    <td>{{ $admin->province }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Contact Number:</td>
                    <td>{{ $admin->contact }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Email:</td>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Password:</td>
                    <td>{{ $admin->password }}</td>
                </tr>
              
            </tbody>
        </table>
        <a href="{{ route('admin.editProfile', $admin->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
    </div>
@endsection
