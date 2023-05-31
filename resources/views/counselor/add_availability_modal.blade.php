<!-- Modal -->
<div class="modal fade" id="addAvailabilityModal" tabindex="-1" aria-labelledby="addAvailabilityModalLabel" aria-hidden="true">
  <form action="/counselor/add-availability" method="POST" id="addAvailabilityForm">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addAvailabilityModalLabel">Add Availability</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                        <label for="date" class="block font-medium text-sm text-gray-700 mb-2">Date</label>
                            <input type="date" class="form-control" id="date" name="date">

                        <label for="start_time" class="block font-medium text-sm text-gray-700 mb-2">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time">

                        <label for="end_time" class="block font-medium text-sm text-gray-700 mb-2">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add_availability">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



