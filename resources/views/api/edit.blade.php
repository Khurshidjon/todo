<div class="modal" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Update Post</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-post">
                   {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="editTitle"></label>
                        <input id="editTitle" type="text" class="form-control" name="title" required value="">
                    </div>
                    <div class="form-group">
                        <label for="editDetail"></label>
                        <textarea id="editDetail"  class="form-control" name="detail" rows="5" ></textarea>
                    </div>
                    <button id="edit" type="submit" class="btn btn-outline-info">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>