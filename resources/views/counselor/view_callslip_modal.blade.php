<div class="modal fade" id="callslipDetailsModal" tabindex="-1" role="dialog" aria-labelledby="callslipDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="callslipDetailsModalLabel">Callslip Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      @if(isset($callslip))
      <p style="text-indent: 20em;"><span id="view-callslip-created"></span></p>

                    <div class="content">
                        <p>Dear <span id="view-student-name">{{ $callslip->student_id ? App\Models\User::find($callslip->student_id)->name : '' }},</p>

                        <p style="text-indent: 4em;">Please see your guidance counselor at the Guidance Center on <strong><span id="view-callslip-date"></strong> at <strong><span id="view-callslip-time"></strong>.</p>

                        <div style="text-indent: 20em;">
                            <p>From:</p>
                            <p><span id="view-counselor-name">{{ App\Models\User::find($callslip->counselor_id)->name }}</p>
                        </div>
          @else
        <p>No callslips found.</p>
    @endif
        </div>

      </div>

    </div>
  </div>
</div>
