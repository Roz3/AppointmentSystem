<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <form action="/instructor/add-referral" method="post" id="updateReferralForm">
        @csrf
        <input type="hidden" id="up_id">

        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Referral</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <label for="student_id">Student Name</label>
                                <select class="form-control" name="up_student_id" id="up_student_id" required>
                                    <option value="">Select a student</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                     @endforeach
                                    </select>

                        <label for="referral_details">Details</label>
                                <textarea class="form-control" name="up_referral_details" id="up_referral_details" rows="5" required></textarea>
                        
                        <label for="referral_previous_interventions">Previous Intervention</label>
                                <textarea class="form-control" name="up_referral_previous_interventions" id="up_referral_previous_interventions" rows="5" required></textarea>
                                

                        <label for="reason_id">Reason for Referral</label>
                                <select class="form-control" name="up_reason_id" id="up_reason_id" required>
                                    <option value="">Reason</option>
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                @endforeach
                                </select>
                            
                        @if(Auth::user()->user_type == 'instructor')
                        <label for="instructor_name">Name:</label>
                                    <input type="text" class="form-control" name="up_instructor_name" id="up_instructor_name" value="{{ Auth::user()->name }}" readonly>
                                    <input type="hidden" name="instructor_id" value="{{ Auth::user()->id }}">
                        @endif
                        
                           
                        </div>

                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_referral">Update</button>
                </div>
            </div>
        </div>
  </form>
</div>
