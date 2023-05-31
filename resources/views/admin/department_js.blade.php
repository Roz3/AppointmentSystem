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
        $(document).on('click','.add_department',function(e){
            e.preventDefault();
            let department= $('#department').val();
            let abbreviation= $('#abbreviation').val();
          
            $.ajax({
                    url:"{{ route('add.department') }}",
                    method: 'post',
                    data:{department:department,abbreviation:abbreviation},
                    success:function(res){
                            if(res.status=='success'){
                                $('#addModal').modal('hide');
                                $('#addDepartmentForm')[0].reset();

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'College Added',
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

        //show department value in update form
        $(document).on('click', '.update_department_form',function(){
            let id = $(this).data('id');
            let department = $(this).data('department');
            let abbreviation = $(this).data('abbreviation');

            $('#up_id').val(id);
            $('#up_department').val(department);
            $('#up_abbreviation').val(abbreviation);
        });

            //update department data
            $(document).on('click','.update_department',function(e){
                e.preventDefault();
                let up_id= $('#up_id').val();
                let up_department= $('#up_department').val();
                let up_abbreviation= $('#up_abbreviation').val();
           

            $.ajax({
                    url:"{{ route('update.department') }}",
                    method: 'post',
                    data:{up_id:up_id,up_department:up_department,up_abbreviation:up_abbreviation},
                    success:function(res){
                            if(res.status=='success'){
                                $('#updateModal').modal('hide');
                                $('#updateDepartmentForm')[0].reset();
                               

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Department Updated',
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

          // view department
       $(document).on('click', '.view-department', function() {
            var departmentId = $(this).data('id');
            $.ajax({
                url: '/admin/department/' + departmentId,
                type: 'GET',
                success: function(department) {
                    $('#view-department').text(department.department);
                    $('#view-abbreviation').text(department.abbreviation);
                    $('#viewDepartmentModal').modal('show'); 
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });

        //delete department data
        $(document).on('click','.delete_department',function(e){
                e.preventDefault();
                let department_id=$(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                    $.ajax({
                            url:"{{ route('delete.department') }}",
                            method: 'post',
                            data:{department_id:department_id},
                            success:function(res){
                                if(res.status=='success'){
                                    location.reload();
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Reason Deleted',
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
