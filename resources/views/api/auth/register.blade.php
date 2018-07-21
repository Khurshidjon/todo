<div class="modal fade" tabindex="-1" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Register user </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="regisForm">
                    {{ csrf_field() }}
{{--
                    {{ method_field('POST') }}
--}}
                    <div class="form-group">
                        <label for="name"></label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="email"></label>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password"></label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password"></label>
                        <input id="confirm_password" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                    <button id="regs" type="submit" class="btn btn-outline-info">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
