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
    $(document).ready(function(){
        $(document).on('click','.add_user',function(e){
            e.preventDefault();
            let name= $('#name').val();
            let email= $('#email').val();
            let year_level= $('#year_level').val();
            let course_id= $('#course_id').val();
            let department_id= $('#department_id').val();
            let barangay= $('#barangay').val();
            let municipal= $('#municipal').val();
            let province= $('#province').val();
            let contact= $('#contact').val();
            let password= $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
            let user_type= $('#user_type').val();
            let profile_image= $('#profile_image').val();
            //console.log(fname+lname+email+password);

            $.ajax({
                    url:"{{ route('add.user') }}",
                    method: 'post',
                    data:{
                        name:name,
                        email:email,
                        year_level:year_level,
                        course_id:course_id,
                        department_id:department_id,
                        barangay:barangay,
                        municipal:municipal,
                        province:province,
                        contact:contact,
                        password:password,
                        password_confirmation:password_confirmation,
                        user_type:user_type,
                        profile_image:profile_image
                    },
                    success:function(res){
                            if(res.status=='success'){
                                $('#addModal').modal('hide');
                                $('#addUserForm')[0].reset();
                        
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'User Added',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                    })
                                    .then(() => {
                        location.reload();
                    });
                 }
                                     
            }, error:function(err){
                let error = err.responseJSON;
                $.each(error.errors,function(index, value){
                    $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
            });
        });

        //show user value in update form
        $(document).on('click', '.update_user_form',function(){
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


       // view user
       $(document).on('click', '.view-user', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: '/admin/user/' + userId,
                type: 'GET',
                success: function(user) {
                    $('#view-name').text(user.name);
                    $('#view-email').text(user.email);
                    $('#view-year_level').text(user.year_level);
                    $('#view-course_id').text(user.course_id);
                    $('#view-department_id').text(user.department_id);
                    $('#view-barangay').text(user.barangay);
                    $('#view-municipal').text(user.municipal);
                    $('#view-province').text(user.province);
                    $('#view-contact').text(user.contact);
                    $('#view-password').text(user.password);
                    $('#view-user-type').text(user.user_type);
                    $('#viewModal').modal('show'); 
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });


            //update user
           
    $(document).on('click', '.update_user', function(e) {
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
            url: "{{ route('update.user') }}",
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
                if (res.status == 'success') {
                    $('#updateModal').modal('hide');
                    $('#updateUserForm')[0].reset();

                    Swal.fire({
                                    title: 'Success!',
                                    text: 'User Updated',
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
                $('.errMsgContainer').empty(); // clear previous error messages
                let error = err.responseJSON;
                $.each(error.errors, function(index, value) {
                    $('.errMsgContainer').append('<div class="alert alert-danger">'+value+'</div>');
                });
            }
        });
    });


        //delete user data
        $(document).on('click','.delete_user',function(e){
                e.preventDefault();
                let user_id=$(this).data('id');

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
                            url:"{{ route('delete.user') }}",
                            method: 'post',
                            data:{user_id:user_id},
                            success:function(res){
                                if(res.status=='success'){
                                    location.reload();

                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'User Deleted',
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

         });
        
</script>
