<div class="modal fade" tabindex="-1" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Create new Post</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action=""  id="create-post">
                   {{ csrf_field() }}
                    <div class="form-group">
                        <label for="newTitle"></label>
                        <input id="newTitle" type="text" class="form-control" name="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="newDetail"></label>
                        <textarea id="newDetail"  class="form-control" name="detail" rows="5" placeholder="Content" ></textarea>
                    </div>
                    <button id="create" type="submit" class="btn btn-outline-info">Add a new Post</button>
                </form>
            </div>
        </div>
    </div>
</div>