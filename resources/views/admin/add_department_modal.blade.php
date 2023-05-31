<!-- Modal -->

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <form action="/admin/add-department" method="POST" id="addDepartmentForm">
        @csrf
        
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add College</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                    <div class="modal-body">

                        <div class="errMsgContainer mb-3">
                        </div>

                        <div class="form-group">
                            <label for="department">College</label>
                                <input type="text" class="form-control" name="department" id="department" required>
                            <label for="abbreviation">Abbreviation</label>
                                <input type="text" class="form-control" name="abbreviation" id="abbreviation">
                        </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_department"style="background-color: #0f52ba; color: white;">Add</button>
                </div>
            </div>
        </div>
  </form>
</div>
