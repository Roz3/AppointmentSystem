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
        $(document).on('click','.add_reason',function(e){
            e.preventDefault();
            let reason= $('#reason').val();
            let description= $('#description').val();
          
            $.ajax({
                    url:"{{ route('add.reason') }}",
                    method: 'post',
                    data:{reason:reason,description:description},
                    success:function(res){
                            if(res.status=='success'){
                                $('#addModal').modal('hide');
                                $('#addReasonForm')[0].reset();
                               

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Reason Added',
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

        //show reason value in update form
        $(document).on('click', '.update_reason_form',function(){
            let id = $(this).data('id');
            let reason = $(this).data('reason');
            let description = $(this).data('description');

            $('#up_id').val(id);
            $('#up_reason').val(reason);
            $('#up_description').val(description);
        });


            // view reason
       $(document).on('click', '.view-reason', function() {
            var reasonId = $(this).data('id');
            $.ajax({
                url: '/admin/reason/' + reasonId,
                type: 'GET',
                success: function(reason) {
                    $('#view-reason').text(reason.reason);
                    $('#view-description').text(reason.description);
                    $('#viewReasonModal').modal('show'); 
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });


            //update reason data
            $(document).on('click','.update_reason',function(e){
                e.preventDefault();
                let up_id= $('#up_id').val();
                let up_reason= $('#up_reason').val();
                let up_description= $('#up_description').val();
           

            $.ajax({
                    url:"{{ route('update.reason') }}",
                    method: 'post',
                    data:{up_id:up_id,up_reason:up_reason,up_description:up_description},
                    success:function(res){
                            if(res.status=='success'){
                                $('#updateModal').modal('hide');
                                $('#updateReasonForm')[0].reset();

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Reason Updated',
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

        //delete reason data
        $(document).on('click','.delete_reason',function(e){
                e.preventDefault();
                let reason_id=$(this).data('id');

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
                            url:"{{ route('delete.reason') }}",
                            method: 'post',
                            data:{reason_id:reason_id},
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
