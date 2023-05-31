<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script>
        $.ajaxSetup({
                headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
    </script>
    <script>



           // view student
       $(document).on('click', '.view-student', function() {
            var studentId = $(this).data('id');
            $.ajax({
                url: '/admin/student/' + studentId,
                type: 'GET',
                success: function(student) {
                    $('#view-name').text(student.name);
                    $('#view-email').text(student.email);
                    $('#view-year_level').text(student.year_level);
                    $('#view-course_id').text(student.course_id);
                    $('#view-department_id').text(student.department_id);
                    $('#view-barangay').text(student.barangay);
                    $('#view-municipal').text(student.municipal);
                    $('#view-province').text(student.province);
                    $('#view-contact').text(student.contact);
                    $('#view-password').text(student.password);
                    $('#view-user-type').text(student.user_type);
                    $('#viewStudentModal').modal('show'); 
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });

          //show student value in update form
          $(document).on('click', '.update_student_form',function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let year_level= $('#year_level').val();
            let course_id= $('#course_id').val();
            let department_id= $('#department_id').val();
            let barangay= $('#barangay').val();
            let municipal= $('#municipal').val();
            let province= $('#province').val();
            let contact= $('#contact').val();
            let password = $(this).data('password');
            let user_type = $(this).data('user_type');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_year_level').val(year_level);
            $('#up_course_id').val(course_id);
            $('#up_department_id').val(department_id);
            $('#up_barangay').val(barangay);
            $('#up_municipal').val(municipal);
            $('#up_province').val(province);
            $('#up_contact').val(contact);
            $('#up_password').val(password);
            $('#up_password_confirmation').val(password);
            $('#up_user_type').val(user_type);
        });


           //update student
           
    $(document).on('click', '.update_student', function(e) {
        e.preventDefault();
        
        let up_id = $('#up_id').val();
        let up_name = $('#up_name').val();
        let up_email = $('#up_email').val();
        let up_year_level= $('#up_year_level').val();
        let up_course_id= $('#up_course_id').val();
        let up_department_id= $('#up_department_id').val();
        let up_barangay= $('#up_barangay').val();
        let up_municipal= $('#up_municipal').val();
        let up_province= $('#up_province').val();
        let up_contact= $('#up_contact').val();
        let up_password = $('#up_password').val();
        let up_password_confirmation = $('#up_password_confirmation').val();
        let up_user_type = $('#up_user_type').val();
        
        $.ajax({
            url: "{{ route('update.student') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                up_id: up_id,
                up_name: up_name,
                up_email: up_email,
                up_year_level:up_year_level,
                up_course_id:up_course_id,
                up_department_id:up_department_id,
                up_barangay:up_barangay,
                up_municipal:up_municipal,
                up_province:up_province,
                up_contact:up_contact,
                up_password: up_password,
                up_password_confirmation: up_password_confirmation,
                up_user_type: up_user_type
            },
            success: function(res) {
                if (res.status === 'success'){
                    $('#updateStudentModal').modal('hide');
                    $('#updateStudentForm')[0].reset();

                    Swal.fire({
                                    title: 'Success!',
                                    text: 'Student Updated',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                    })
                                    .then(() => {
                            location.reload();
                        });
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                $.each(error.errors, function(index, value) {
                    $('.errMsgContainer').append('<div class="alert alert-danger">'+value+'</div>');
                });
            }
        });
    });

      //delete student
      $(document).on('click','.delete_student',function(e){
                e.preventDefault();
                let student_id=$(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('delete.student') }}",
                            method: 'post',
                            data:{student_id:student_id},
                            success:function(res){
                                if(res.status=='success'){
                                    location.reload();

                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Student Deleted',
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            }
                        });
                    }
                });
        });

         


    </script>