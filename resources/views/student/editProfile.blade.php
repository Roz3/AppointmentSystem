@extends('layouts.studentLayout')

@section('content')
    <h1 class="text-xl font-bold mb-2">Edit Profile</h1>
    <div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('student.updateProfile', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" readonly>
            </div>
            <div class="flex mb-2">
            <div class="mr-2">
                <label for="department_id" class="block text-gray-700 font-bold mb-2">College:</label>
                <select class="form-control" name="department_id" id="department_id">
                    <option value="">--- Choose ---</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                     @endforeach
                    </select>
            </div>

            <div class="mr-2">
                <label for="course_id" class="block text-gray-700 font-bold mb-2">Course:</label>
                <select class="form-control" name="course_id" id="course_id">
                    <option value="">--- Choose ---</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course }}</option>
                     @endforeach
                    </select>
            </div>
            <div class="mr-2">
                <label for="year_level" class="block text-gray-700 font-bold mb-2">Year Level:</label>
                <select id="year_level" name="year_level" class="form-control">
                        <option value="">-- Choose --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                </select>
            </div>
            </div>

            <div class="flex mb-2">
                <div class="mr-2">
                    <label for="barangay" class="block text-gray-700 font-bold mb-2">Barangay:</label>
                    <input type="text" name="barangay" id="barangay" class="form-control" value="{{ $student->barangay }}">
                </div>

                <div class="mr-2">
                    <label for="municipal" class="block text-gray-700 font-bold mb-2">Municipal:</label>
                    <input type="text" name="municipal" id="municipal" class="form-control" value="{{ $student->municipal }}">
                </div>

                <div>
                    <label for="province" class="block text-gray-700 font-bold mb-2">Province:</label>
                    <input type="text" name="province" id="province" class="form-control" value="{{ $student->province }}">
                </div>
            </div>

            <div class="mb-2">
                <label for="contact" class="block text-gray-700 font-bold mb-2">Contact Number:</label>
                <input type="text" name="contact" id="contact" class="form-control" value="{{ $student->contact }}" placeholder="+63 XXX-XXXX-XXX">
            </div>

            
            <div class="mb-2">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" readonly>
            </div>

    
            <div class="mb-2">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" value="{{ $student->password }}">
                    <button class="btn btn-outline-primary" type="button" id="showPasswordBtn">
                        <i class="fas fa-eye" id="showPasswordIcon"></i>
                    </button>
                </div>
            </div>


            <button type="submit"class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded no-underline" id="saveChangesBtn"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#showPasswordBtn').click(function() {
                var passwordField = $('#password');
                var passwordType = passwordField.attr('type');
                var passwordIcon = $('#showPasswordIcon');

                if (passwordType === 'password') {
                    passwordField.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#saveChangesBtn').click(function() {
                Swal.fire({
                    title: 'Success',
                    text: 'Changes saved successfully',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>


@endsection
