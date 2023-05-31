
<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="/admin/add-user" method="post" id="updateUserForm">
        @csrf
        <input type="hidden" name="up_id" id="up_id">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <div class="errMsgContainer mb-3"></div>

                <div class="form-group">
                    <label for="up_name">Full Name</label>
                    <input type="text" class="form-control" name="up_name" id="up_name" required>

                    <label for="up_email">Email</label>
                    <input type="email" class="form-control" name="up_email" id="up_email" required>
                    <label for="up_year_level">Year Level</label>
                                <select id="up_year_level" name="up_year_level" class="form-control">
                                        <option value="">-- Choose --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
                    <label for="up_course_id">Course</label>
                                <select class="form-control" name="up_course_id" id="up_course_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}</option>
                                     @endforeach
                                    </select>
                    <label for="up_department_id">Department</label>
                                <select class="form-control" name="up_department_id" id="up_department_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                                     @endforeach
                                    </select>
                    <label for="up_barangay">Barangay</label>
                                <input type="text" class="form-control" name="up_barangay" id="up_barangay">
                    <label for="up_municipal">Municipality</label>
                                <input type="text" class="form-control" name="up_municipal" id="up_municipal">
                    <label for="up_province">Province</label>
                                <input type="text" class="form-control" name="up_province" id="up_province">
                    <label for="up_contact">Contact Number</label>
                                <input type="text" class="form-control" name="up_contact" id="up_contact">
                    <label for="up_password">Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="up_password" id="up_password" required autocomplete="new-password">
                        <button class="btn btn-outline-primary" type="button" id="showUpPasswordBtn">
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>

                    <label for="up_password_confirmation">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="up_password_confirmation" id="up_password_confirmation">
                        <button class="btn btn-outline-primary" type="button" id="showUpConfirmPasswordBtn">
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>

                    <label for="up_user_type">User Type</label>
                    <select id="up_user_type" name="up_user_type" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="admin">Admin</option>
                        <option value="counselor">Counselor</option>
                        <option value="instructor">Instructor</option>
                        <option value="student">Student</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_user">Update</button>
            </div>
        </div>
    </div>
</form>
</div>
<script>
$(document).ready(function() {
  $('#showUpPasswordBtn').click(function() {
    var upPasswordField = $('#up_password');
    var upPasswordType = upPasswordField.attr('type');
    var upPasswordIcon = $(this).find('i');

    if (upPasswordType === 'password') {
      upPasswordField.attr('type', 'text');
      upPasswordIcon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      upPasswordField.attr('type', 'password');
      upPasswordIcon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });

  $('#showUpConfirmPasswordBtn').click(function() {
    var upConfirmPasswordField = $('#up_password_confirmation');
    var upConfirmPasswordType = upConfirmPasswordField.attr('type');
    var upConfirmPasswordIcon = $(this).find('i');

    if (upConfirmPasswordType === 'password') {
      upConfirmPasswordField.attr('type', 'text');
      upConfirmPasswordIcon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      upConfirmPasswordField.attr('type', 'password');
      upConfirmPasswordIcon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });
});
</script>
