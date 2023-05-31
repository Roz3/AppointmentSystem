<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <form action="/counselor/add-callslip" method="post" id="updateCallslipForm">
        @csrf
        <input type="hidden" id="up_id">

        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Reschedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <label for="student_id">Student Name</label>
                                <select class="form-control" name="up_student_id" id="up_student_id" required>
                                    <option value="">Select a student</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                     @endforeach
                                    </select>
                        <label for="instructor_id">Referred by</label>
                                <select class="form-control" name="up_instructor_id" id="up_instructor_id">
                                    <option value="">Select instructor</option>
                                    @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                     @endforeach
                                    </select>
                        
                        <label for="date">Date</label>
                                <input type="date" class="form-control" name="up_date" id="up_date" required>

                        <label for="time">Time</label>
                                <input type="time" class="form-control" name="up_time" id="up_time" required>

                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_callslip">Update</button>
                </div>
            </div>
        </div>
  </form>
</div>
