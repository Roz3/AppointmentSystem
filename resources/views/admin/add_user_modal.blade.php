<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="/admin/add-user" method="POST" id="addUserForm">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                
                            <label for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            <label for="year_level">Year Level</label>
                                <select id="year_level" name="year_level" class="form-control">
                                        <option value="">-- Choose --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
                            <label for="department_id">Department</label>
                                <select class="form-control" name="department_id" id="department_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                                    @endforeach
                                </select>
                            <label for="course_id">Course</label>
                                <select class="form-control" name="course_id" id="course_id">
                                    <option value="">--- Choose ---</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}</option>
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
                                <input type="password" class="form-control" name="password" id="password" required>
                                <button class="btn btn-outline-primary" type="button" id="showPasswordBtn">
                                    <i class="fas fa-eye"></i>
                                </button>
                                </div>
                            <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                <button class="btn btn-outline-primary" type="button" id="showConfirmPasswordBtn">
                                    <i class="fas fa-eye"></i>
                                </button>
                                </div>

                            <label for="user_type">User Type</label>
                                <select id="user_type" name="user_type" class="form-control">
                                        <option value="">-- Choose --</option>
                                        <option value="admin">Admin</option>
                                        <option value="counselor">Counselor</option>
                                        <option value="instructor">Instructor</option>
                                        <option value="student">Student</option>
                                    
                                </select>
                        </div>

                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_user"style="background-color: #0f52ba; color: white;">Add</button>
                </div>
            </div>
        </div>
  </form>
</div>

<script>
$(document).ready(function() {
  $('#department_id').change(function() {
    var department_id = $(this).val();
    if (department_id != '') {
      $.ajax({
        url: '/get-courses/' + department_id,
        type: 'get',
        dataType: 'json',
        success: function(response) {
          $('#course_id').empty();
          $('#course_id').append('<option value="">--- Choose ---</option>');
          $.each(response, function(index, course) {
            $('#course_id').append('<option value="' + course.id + '">' + course.course + '</option>');
          });
        }
      });
    } else {
      $('#course_id').empty();
      $('#course_id').append('<option value="">--- Choose ---</option>');
    }
  });
});

$(document).ready(function() {
  $('#showPasswordBtn').click(function() {
    var passwordField = $('#password');
    var passwordType = passwordField.attr('type');
    var passwordIcon = $(this).find('i');

    if (passwordType === 'password') {
      passwordField.attr('type', 'text');
      passwordIcon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      passwordField.attr('type', 'password');
      passwordIcon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });

  $('#showConfirmPasswordBtn').click(function() {
    var confirmPasswordField = $('#password_confirmation');
    var confirmPasswordType = confirmPasswordField.attr('type');
    var confirmPasswordIcon = $(this).find('i');

    if (confirmPasswordType === 'password') {
      confirmPasswordField.attr('type', 'text');
      confirmPasswordIcon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      confirmPasswordField.attr('type', 'password');
      confirmPasswordIcon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });
});


</script>