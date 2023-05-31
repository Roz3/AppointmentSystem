<!-- Modal -->

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="/admin/add-course" method="POST" id="addCourseForm">
        @csrf
        
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                            <label for="course">Course</label>
                                <input type="text" class="form-control" name="course" id="course" required>
                            <label for="abbreviation">Abbreviation</label>
                                <input type="text" class="form-control" name="abbreviation" id="abbreviation" required>
                            <label for="department_id">College</label>
                                <select class="form-control" name="department_id" id="department_id">
                                <option value="">--- Choose ---</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_course"style="background-color: #0f52ba; color: white;">Add</button>
                </div>
            </div>
        </div>
  </form>
</div>
