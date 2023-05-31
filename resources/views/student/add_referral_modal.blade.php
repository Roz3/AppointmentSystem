<!-- Modal -->
<div class="modal fade" id="addReferralModal" tabindex="-1" aria-labelledby="addReferralModalLabel" aria-hidden="true">
  <form action="/student/add-referral" method="POST" id="addReferralForm">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addReferralModalLabel">Referral Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>
                        <label for="student_id">Student Name</label>
                                <select class="form-control" name="student_id" id="student_id" required>
                                    <option value="">---choose---</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                     @endforeach
                                    </select>

                        <label for="referral_details">Details</label>
                                <textarea class="form-control" name="referral_details" id="referral_details" rows="4" ></textarea>

                        <label for="referral_previous_interventions">Previous Intervention</label>
                                <textarea class="form-control" name="referral_previous_interventions" id="referral_previous_interventions" rows="4"></textarea>

                        <div class="form-group">

                        <label for="reason_id">Reason for Referral</label>
                            <select class="form-control" name="reason_id" id="reason_id">
                                    <option value="">---choose---</option>
                                    @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                    @endforeach
                            </select>


                        @if(Auth::user()->user_type == 'student')
                            <label for="student_name">Name:</label>
                                <input type="text" class="form-control" name="student_name" id="student_name" value="{{ Auth::user()->name }}" readonly>
                                <input type="hidden" name="student_id" value="{{ Auth::user()->id }}">
                         @endif

                         <p style="margin-top: 10px;">Best Time to Meet the Student:</p>

                        <div class="form-group">
                        <label for="first_choice">First Choice</label>
                        <select class="form-control" name="first_choice" id="first_choice">
                            <option value="">--- Choose ---</option>
                            @foreach($availabilities as $availability)
                            <option value="{{ \Carbon\Carbon::parse($availability->date.' '.$availability->start_time)->format('Y-m-d H:i:s') }}">
                                {{ \Carbon\Carbon::parse($availability->date.' '.$availability->start_time)->isoFormat('LL LT') }}
                                - {{ \Carbon\Carbon::parse($availability->date.' '.$availability->end_time)->isoFormat('LL LT') }}
                            </option>
                            @endforeach
                        </select>

                        <label for="second_choice">Second Choice</label>
                        <select class="form-control" name="second_choice" id="second_choice">
                            <option value="">--- Choose ---</option>
                            @foreach($availabilities as $availability)
                            <option value="{{ \Carbon\Carbon::parse($availability->date.' '.$availability->start_time)->format('Y-m-d H:i:s') }}">
                                {{ \Carbon\Carbon::parse($availability->date.' '.$availability->start_time)->isoFormat('LL LT') }}
                                - {{ \Carbon\Carbon::parse($availability->date.' '.$availability->end_time)->isoFormat('LL LT') }}
                            </option>
                            @endforeach
                        </select>

                            </div>

                        <label for="counselor_id">Counselor Name</label>
                                <select class="form-control" name="counselor_id" id="counselor_id" required>
                                    <option value="">---choose---</option>
                                    @foreach($counselors as $counselor)
                                    <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="button" class="btn btn-primary add_referral">ADD</button>
                </div>
            </div>
        </div>
  </form>
</div>
