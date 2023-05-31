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

$(document).ready(function() {
    $('[data-bs-target="#addModal"]').click(function() {
        var studentName = $(this).data('student-name');
        var instructorName = $(this).data('instructor-name');
        $('#student_name').val(studentName);
        $('#instructor_name').val(instructorName);
    });

    $(document).on('click', '.add_callslip', function(e) {
        e.preventDefault();
        var student_id = $('#student_id').val();
        var instructor_id = $('#instructor_id').val();
        var date = $('#date').val();
        var time = $('#time').val();

        $.ajax({
            url: "{{ route('add.callslip') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                student_id: student_id,
                instructor_id: instructor_id,
                date: date,
                time: time
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#addModal').modal('hide');
                    $('#addCallslipForm')[0].reset();

                    Swal.fire({
                        title: 'Success!',
                        text: 'Callslip Added',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function(err) {
                var error = err.responseJSON;
                $('.errMsgContainer').html(''); // Clear previous error messages
                $.each(error.errors, function(index, value) {
                    $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                });
            }
        });
    });
});

//show callslip value in update form
$(document).on('click', '.update_callslip_form',function(){
    let id = $(this).data('id');
    let student_id = $(this).data('student_id');
    let instructor_id = $(this).data('instructor_id');
    let date = $(this).data('date');
    let time = $(this).data('time');

    $('#up_id').val(id);
    $('#up_student_id').val(student_id);
    $('#up_instructor_id').val(instructor_id);
    $('#up_date').val(date);
    $('#up_time').val(time);
});

//update
$(document).on('click','.update_callslip',function(e){
    e.preventDefault();
    let up_id= $('#up_id').val();
    let up_student_id= $('#up_student_id').val();
    let up_instructor_id= $('#up_instructor_id').val();
    let up_date= $('#up_date').val();
    let up_time= $('#up_time').val();

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to update this callslip!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"{{ route('update.callslip') }}",
                method: 'post',
                data:{up_id:up_id,up_student_id:up_student_id,up_instructor_id:up_instructor_id,up_date:up_date,up_time:up_time},
                success:function(res){
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');
                        $('#updateCallslipForm')[0].reset();
                        Swal.fire({
                            title: 'Success!',
                            text: 'Callslip Updated',
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
        }
    });
});


         //delete
         $(document).on('click','.delete_callslip',function(e){
            e.preventDefault();
            let callslip_id=$(this).data('id');

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
                        url:"{{ route('delete.callslip') }}",
                        method: 'post',
                        data:{callslip_id:callslip_id},
                        success:function(res){
                            if(res.status=='success'){
                                location.reload();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Callslip Deleted',
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

         //complete callslip
        $(document).on('click', '.complete-callslip-btn', function(e){
            e.preventDefault();
            let callslip_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/callslips') }}/" + callslip_id + "/complete",
                        method: 'get',
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Call Slip completed',
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

        //cancel
        $(document).on('click', '.cancel-callslip-btn', function(e){
            e.preventDefault();
            let callslip_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/callslips') }}/" + callslip_id + "/cancel",
                        method: 'get',
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Call Slip cancelled',
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


        //view callslip

        $(document).on('click', '.view-callslip', function() {
    var callslipId = $(this).data('id');
    $.ajax({
        url: '/student/callslip/' + callslipId,
        type: 'GET',
        success: function(callslip) {
            
            $('#view-student-name').text(callslip.student_id ? callslip.student_id.name : '');
            $('#view-counselor-name').text(callslip.counselor_id.name);
            $('#view-instructor-name').text(callslip.instructor_id);
            
            var date = moment(callslip.date).format('LL');
            var time = moment(callslip.time, 'HH:mm:ss').format('LT');

            $('#view-callslip-date').text(date);
            $('#view-callslip-time').text(time);
            $('#view-callslip-created').text(new Date(callslip.created_at).toLocaleDateString('en-PH'));
           
           
            $('#callslipDetailsModal').modal('show');
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        }
    });
});



</script>