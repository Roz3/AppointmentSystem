<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="/counselor/add-callslip" method="POST" id="addCallslipForm">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Call Slip Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <input type="hidden" name="student_id" id="student_id" value="{{ $referral->student_id ?? '' }}">
                            <input type="text" class="form-control" id="student_name" value="{{ isset($referral) ? App\Models\User::find($referral->student_id)->name : '' }}" readonly>

                            <label for="instructor_name">Referred by</label>
                            <input type="hidden" name="instructor_id" id="instructor_id" value="{{ $referral->instructor_id ?? '' }}">
                            <input type="text" class="form-control" id="instructor_name" value="{{ isset($referral) ? App\Models\User::find($referral->instructor_id)->name : '' }}" readonly>

                            @if(Auth::user()->user_type == 'counselor')
                                <label for="counselor_name">Name:</label>
                                <input type="text" class="form-control" name="counselor_name" id="counselor_name" value="{{ Auth::user()->name }}" readonly>
                                <input type="hidden" name="counselor_id" value="{{ Auth::user()->id }}">
                            @endif

                            <label for="date">Date</label>
                            <select class="form-control" name="date" id="date" required>
                                <option value="">---choose---</option>
                                @if(isset($referral))
                                    <option value="{{ \Carbon\Carbon::parse($referral->first_choice)->toDateString() }}">{{ \Carbon\Carbon::parse($referral->first_choice)->toDateString() }}</option>
                                    <option value="{{ \Carbon\Carbon::parse($referral->second_choice)->toDateString() }}">{{ \Carbon\Carbon::parse($referral->second_choice)->toDateString() }}</option>
                                @endif
                            </select>

                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time" id="time" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add_callslip">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
