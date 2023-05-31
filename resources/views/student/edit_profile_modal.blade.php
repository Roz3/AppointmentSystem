
<!-- Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <form action="/admin/add-user" method="post" id="updateProfileForm">
        @csrf
        <input type="hidden" name="up_id" id="up_id">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <div class="errMsgContainer mb-3"></div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>

                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                    <label for="up_year_level">Year Level</label>
                                <select id="up_year_level" name="up_year_level" class="form-control">
                                        <option value="">-- Choose --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
                    <label for="course_id">Course</label>
                                <select class="form-control" name="course_id" id="course_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}</option>
                                     @endforeach
                                    </select>
                    <label for="department_id">Department</label>
                                <select class="form-control" name="department_id" id="department_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                                     @endforeach
                                    </select>
                    <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" name="barangay" id="barangay">
                    <label for="municipal">Municipality</label>
                                <input type="text" class="form-control" name="municipal" id="municipal">
                    <label for="province">Province</label>
                                <input type="text" class="form-control" name="province" id="province">
                    <label for="contact">Contact Number</label>
                                <input type="text" class="form-control" name="contact" id="contact">
                    <label for="password">Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" required autocomplete="new-password">
                        <button class="btn btn-outline-primary" type="button" id="showUpPasswordBtn">
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>

                    <label for="password_confirmation">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        <button class="btn btn-outline-primary" type="button" id="showUpConfirmPasswordBtn">
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_student">Update</button>
            </div>
        </div>
    </div>
</form>
</div>
<script>
$(document).ready(function() {
  $('#showUpPasswordBtn').click(function() {
    var upPasswordField = $('#password');
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
    var upConfirmPasswordField = $('#password_confirmation');
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