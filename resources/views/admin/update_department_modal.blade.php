<!-- Modal -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <form action="/admin/add-department" method="post" id="updateDepartmentForm">
        @csrf
        <input type="hidden" id="up_id">

        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update College</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                                <input type="text" class="form-control" name="up_department" id="up_department" required>
                            <label for="abbreviation">Abbreviation</label>
                                <input type="text" class="form-control" name="up_abbreviation" id="up_abbreviation" required>
                        </div>

                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_department"style="background-color: #0f52ba; color: white;">Update</button>
                </div>
            </div>
        </div>
  </form>
</div>
