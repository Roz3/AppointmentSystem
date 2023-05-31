<!-- Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <form action="/counselor/add-note" method="POST" id="addNoteForm">
        @csrf
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNoteModalLabel">Add note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3"></div>
                    <div class="form-group">
                        <input type="hidden" name="callslip_id" id="callslip_id" value="">
                        <label for="content">Note</label>
                        <textarea class="form-control" name="content" id="content" rows="4"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_note" style="background-color: #0f52ba; color: white;">ADD</button>
                </div>
            </div>
        </div>
    </form>
</div>
