@extends('layouts.studentLayout')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-xl mb-4"><i class="fas fa-user-circle"></i> My Profile</h4>
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-bold">Name:</td>
                    <td>{{ $student->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold">College:</td>
                    <td>{{ $student->department_id ? App\Models\Department::find($student->department_id)->department : '' }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Course:</td>
                    <td>{{ $student->course_id ? App\Models\Course::find($student->course_id)->course : '' }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Year Level:</td>
                    <td>{{ $student->year_level }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Barangay:</td>
                    <td>{{ $student->barangay }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Municipal:</td>
                    <td>{{ $student->municipal }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Province:</td>
                    <td>{{ $student->province }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Contact Number:</td>
                    <td>{{ $student->contact }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Email:</td>
                    <td>{{ $student->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Password:</td>
                    <td>{{ $student->password }}</td>
                </tr>
        </tbody>
    </table>

    <a href="{{ route('student.editProfile', $student->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
    </div>

@endsection