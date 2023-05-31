<!-- Modal -->

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="/admin/add-reason" method="POST" id="addReasonForm">
        @csrf
        
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                            <label for="reason">Name</label>
                                <input type="text" class="form-control" name="reason" id="reason" required>
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" required></textarea>

                        </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_reason" style="background-color: #0f52ba; color: white;">Add</button>
                </div>
            </div>
        </div>
  </form>
</div>
