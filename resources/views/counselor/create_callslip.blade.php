@extends('layouts.cLayout')

@section('content')
<div class="form-group">
                            <label for="student_id">Student Name</label>
                                <select class="form-control" name="student_id" id="student_id" required>
                                    <option value="">Select a student</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                     @endforeach
                                    </select>

                            <label for="instructor_id">Referred by</label>
                                <select class="form-control" name="instructor_id" id="instructor_id" >
                                    <option value="">Select Instructor</option>
                                    @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                     @endforeach
                                    </select>

                            <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date" required>

                            <label for="time">Time</label>
                                <input type="time" class="form-control" name="time" id="time" required>

                        </div>
                        </div>
    

@endsection

