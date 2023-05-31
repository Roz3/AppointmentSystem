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

        //add
        $(document).ready(function(){
        $(document).on('click','.add_availability',function(e){
            e.preventDefault();
            let availability= $('#availability').val();
            let counselor_id= $('#counselor_id').val();
            let date= $('#date').val();
            let start_time= $('#start_time').val();
            let end_time= $('#end_time').val();

          
            $.ajax({
                    url:"{{ route('add.availability') }}",
                    method: 'post',
                    data:{availability:availability,
                        counselor_id:counselor_id,
                        date:date,
                        start_time:start_time,
                        end_time:end_time
                    },
                    success:function(res){
                            if(res.status=='success'){
                                $('#addModal').modal('hide');
                                $('#addAvailabilityForm')[0].reset();
                    

                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Availability Added',
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


        //delete
         $(document).on('click','.delete_availability',function(e){
            e.preventDefault();
            let availability_id=$(this).data('id');

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
                        url:"{{ route('delete.availability') }}",
                        method: 'post',
                        data:{availability_id:availability_id},
                        success:function(res){
                            if(res.status=='success'){
                                location.reload();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Availability Deleted',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                }
            });   
            return false;
        });

    });
</script>