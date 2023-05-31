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


//view callslip

$(document).on('click', '.view-callslip', function() {
var callslipId = $(this).data('id');
$.ajax({
url: '/student/callslip/' + callslipId,
type: 'GET',
success: function(callslip) {
    // populate the modal with callslip details
    $('#view-student-name').text(callslip.student_id.name);
    $('#view-counselor-name').text(callslip.counselor_id.name);
    $('#view-instructor-name').text(callslip.instructor_id);
    
    // format the date and time to the Philippine standard
    var date = moment(callslip.date).format('LL');
    var time = moment(callslip.time, 'HH:mm:ss').format('LT');

    $('#view-callslip-date').text(date);
    $('#view-callslip-time').text(time);
    $('#view-callslip-created').text(new Date(callslip.created_at).toLocaleDateString('en-PH'));
   
    // show the modal
    $('#callslipDetailsModal').modal('show');
},
error: function(xhr, textStatus, errorThrown) {
    console.log(xhr.responseText);
}
});
});
</script>