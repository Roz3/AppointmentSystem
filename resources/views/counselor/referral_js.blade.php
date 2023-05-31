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
    
         //approve referral
         $(document).on('click', '.approve-referral-btn', function(e){
            e.preventDefault();
            let referral_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/referrals') }}/" + referral_id + "/approve",
                        method: 'get',
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Referral Approved',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                })
                                .then(() => {
                            location.reload();
                        });
                            }
                        }
                    });
                }
            });   
        });


         //view referral
         $(document).on('click', '.view-referral', function() {
    var referralId = $(this).data('id');
    $.ajax({
        url: '/counselor/referral/' + referralId,
        type: 'GET',
        success: function(referral) {
            // populate the modal with referral details
            $('#view-student-name').text(referral.student_id);
            $('#view-referral-details').text(referral.referral_details);
            $('#view-referral-previous-interventions').text(referral.referral_previous_interventions);
            $('#view-counselor-name').text(referral.counselor_id);
            $('#view-instructor-name').text(referral.instructor_id);
            $('#view-referral-date').text(referral.date);
            $('#view-referral-reason').text(referral.reason_id.name);
            $('#view-first-choice').text(referral.formatted_first_choice);
            $('#view-second-choice').text(referral.formatted_second_choice);



            // show the modal
            $('#referralDetailsModal').modal('show');
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        }
    });
});

   //delete
   $(document).on('click','.delete_referral',function(e){
            e.preventDefault();
            let referral_id=$(this).data('id');

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
                        url:"{{ route('delete.referral') }}",
                        method: 'post',
                        data:{referral_id:referral_id},
                        success:function(res){
                            if(res.status=='success'){
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


        </script>