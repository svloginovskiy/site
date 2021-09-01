<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="col-md-auto border rounded m-3">
            <form class="form-floating " action="/login" method="POST">
                <h1>Log in</h1>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usernameInput" placeholder="username" name="name"
                           required>
                    <label for="usernameInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="passwordInput" placeholder="password"
                           name="password" required>
                    <label for="passwordInput">Password</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Log in</button>
            </form>
        </div>
    </div>
</div>