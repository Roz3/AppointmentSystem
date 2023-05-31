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
        $(document).on('click', '.add-note', function(e){
            e.preventDefault();
            
            let callslip_id = $(this).data('id');
            let content = $('#content').val();
            
            $.ajax({
                url: "{{ route('add.note') }}",
                method: 'post',
                data: {
                    callslip_id: callslip_id,
                    content: content
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addNoteModal').modal('hide');
                        $('#addNoteForm')[0].reset();
                        
                        Swal.fire({
                            title: 'Success!',
                            text: 'Note Added',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $('.errMsgContainer').empty();
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }
            });
        });
    });


</script>
