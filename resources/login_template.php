<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="col-md-auto border rounded m-3">
            <form class="form-floating " action="/login" method="POST">
                <h1>Log in</h1>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?= $authFailed ? 'is-invalid' : '' ?>" id="usernameInput"
                           placeholder="username" name="name"
                           required>
                    <label for="usernameInput">Username</label>
                    <div class="invalid-feedback">
                        Username or password are incorrect!
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?= $authFailed ? 'is-invalid' : '' ?>"
                           id="passwordInput" placeholder="password"
                           name="password" required>
                    <label for="passwordInput">Password</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </div>
</div>