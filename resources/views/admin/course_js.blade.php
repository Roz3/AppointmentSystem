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
        $(document).on('click','.add_course',function(e){
            e.preventDefault();
            let course= $('#course').val();
            let abbreviation= $('#abbreviation').val();
            let department_id= $('#department_id').val();

          
            $.ajax({
                    url:"{{ route('add.course') }}",
                    method: 'post',
                    data:{course:course,
                        abbreviation:abbreviation,
                        department_id:department_id
                    },
                    success:function(res){
                            if(res.status=='success'){
                                $('#addModal').modal('hide');
                                $('#addCourseForm')[0].reset();
                    

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Course Added',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                    }).then(() => {
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



        //show course value in update form
        $(document).on('click', '.update_course_form',function(){
            let id = $(this).data('id');
            let course = $(this).data('course');
            let abbreviation = $(this).data('abbreviation');
            let department_id = $(this).data('department_id');
            

            $('#up_id').val(id);
            $('#up_course').val(course);
            $('#up_abbreviation').val(abbreviation);
            $('#up_department_id').val(department_id);
          
        });


         // view course
       $(document).on('click', '.view-course', function() {
            var courseId = $(this).data('id');
            $.ajax({
                url: '/admin/course/' + courseId,
                type: 'GET',
                success: function(course) {
                    $('#view-course').text(course.course);
                    $('#view-abbreviation').text(course.abbreviation);
                    $('#viewCourseModal').modal('show'); 
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });


            //update course data
            $(document).on('click','.update_course',function(e){
                e.preventDefault();
                let up_id= $('#up_id').val();
                let up_course= $('#up_course').val();
                let up_abbreviation= $('#up_abbreviation').val();
                let up_department_id= $('#up_department_id').val();
                
           

            $.ajax({
                    url:"{{ route('update.course') }}",
                    method: 'post',
                    data:{up_id:up_id,
                        up_course:up_course,
                        up_abbreviation:up_abbreviation,
                        up_department_id:up_department_id
                    },
                    success:function(res){
                            if(res.status=='success'){
                                $('#updateModal').modal('hide');
                                $('#updateCourseForm')[0].reset();
                                location.reload();

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Course Updated',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                    })
                            }
                    }, error:function(err){
                        let error = err.responseJSON;
                        $.each(error.errors,function(index, value){
                            $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                        });
                    }
            });
        });

        //delete course data
        $(document).on('click','.delete_course',function(e){
                e.preventDefault();
                let course_id=$(this).data('id');

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
                            url:"{{ route('delete.course') }}",
                            method: 'post',
                            data:{course_id:course_id},
                            success:function(res){
                                if(res.status=='success'){
                                    location.reload();

                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Course Deleted',
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
