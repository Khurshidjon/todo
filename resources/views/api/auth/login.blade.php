<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Login</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="loginForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pochta"></label>
                        <input id="pochta" type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="parol"></label>
                        <input id="parol" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
                    </div>
                    <button id="login" type="submit" class="btn btn-outline-info">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>