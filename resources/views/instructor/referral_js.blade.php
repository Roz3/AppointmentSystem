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
    $(document).on('click','.add_referral',function(e){
        e.preventDefault();
        let student_id= $('#student_id').val();
        let referral_details= $('#referral_details').val();
        let referral_previous_interventions= $('#referral_previous_interventions').val();
        let reason_id= $('#reason_id').val();
        let instructor_id= $('#instructor_id').val();
        let first_choice= $('#first_choice').val();
        let second_choice= $('#second_choice').val();
        let counselor_id= $('#counselor_id').val();

        $.ajax({
            url:"{{ route('add.referral') }}" ,
            method: 'post',
            data:{
                student_id:student_id,
                referral_details:referral_details,
                referral_previous_interventions: referral_previous_interventions, 
                reason_id:reason_id, 
                instructor_id:instructor_id,
                first_choice:first_choice,
                second_choice:second_choice,
                counselor_id:counselor_id
            },
            success:function(res){
                if(res.status=='success'){
                    $('#addModal').modal('hide');
                    $('#addReferralForm')[0].reset();

                    Swal.fire({
                        title: 'Success!',
                        text: 'Referral Added',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                }
            }, 
            error:function(err){
                let error = err.responseJSON;
                $.each(error.errors,function(index, value){
                    $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
        });
    });
});


        //show referral value in update form
        $(document).on('click', '.update_referral_form',function(){
            let id = $(this).data('id');
            let student_id = $(this).data('student_id');
            let referral_details = $(this).data('referral_details');
            let referral_previous_interventions = $(this).data('referral_previous_interventions');
            let reason_id = $(this).data('reason_id');
           

            $('#up_id').val(id);
            $('#up_student_id').val(student_id);
            $('#up_referral_details').val(referral_details);
            $('#up_referral_previous_interventions').val(referral_previous_interventions);
            $('#up_reason_id').val(reason_id);
            
        });

            //update referral
            $(document).on('click','.update_referral',function(e){
                e.preventDefault();
                let up_id= $('#up_id').val();
                let up_student_id= $('#up_student_id').val();
                let up_referral_details= $('#up_referral_details').val();
                let up_referral_previous_interventions= $('#up_referral_previous_interventions').val();
                let up_reason_id= $('#up_reason_id').val();
                
           

            $.ajax({
                    url:"{{ route('update.referral') }}",
                    method: 'post',
        
                    data:{up_id:up_id,
                        up_student_id:up_student_id,
                        up_referral_details:up_referral_details,
                        up_referral_previous_interventions:up_referral_previous_interventions,
                        up_reason_id:up_reason_id
                    },
                    success:function(res){
                            if(res.status=='success'){
                                $('#updateModal').modal('hide');
                                $('#updateReferralForm')[0].reset();
                                $('.table').load(location.href+' .table');
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Referral Updated',
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

        $(document).on('click', '.delete_referral', function(e) {
            e.preventDefault();
            let referral_id = $(this).data('id');

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
                        url: $(this).attr('href'),
                        method: 'POST',
                        data: { referral_id: referral_id },
                        success: function(res) {
                            if (res.status == 'success') {
                                location.reload();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Referral Deleted',
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

        //view referral
        $(document).on('click', '.view-referral', function() {
    var referralId = $(this).data('id');
    $.ajax({
        url: '/instructor/referral/' + referralId,
        type: 'GET',
        success: function(referral) {
            // populate the modal with referral details
            if (referral.student_id && referral.student_id.name) {
                $('#view-student-name').text(referral.student_id.name);
            }
            $('#view-referral-details').text(referral.referral_details);
            $('#view-referral-previous-interventions').text(referral.referral_previous_interventions);
            $('#view-counselor-name').text(referral.counselor_id);
            $('#view-instructor-name').text(referral.instructor_id);
            $('#view-referral-date').text(referral.date);
            $('#view-referral-reason').text(referral.reason_id);
            $('#view-first-choice').text(referral.first_choice);
            $('#view-second-choice').text(referral.second_choice);

            // show the modal
            $('#referralDetailsModal').modal('show');
        },

        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        }
    });
});


       

      

</script>