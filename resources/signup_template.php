<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="col-md-auto border rounded m-3 shadow">
            <form class="form-floating " action="/signup" method="POST">
                <h1 class="fw-bold">Sign up</h1>
                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control <?= isset($isNameValid) ? ($isNameValid && $isNameAvailable ? 'is-valid' : 'is-invalid') : '' ?> "
                           id="usernameInput" placeholder="username"
                           name="name" <?= isset($name) ? "value=\"$name\"" : '' ?>
                           required>
                    <label for="usernameInput">Username</label>
                    <div class="invalid-feedback">
                        <?= $isNameValid ? 'Username is already taken!' : 'Username should contain latin letters, digits or _' ?>
                    </div>
                    <div class="valid-feedback">
                        Nice username!
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email"
                           class="form-control <?= isset($isEmailValid) ? ($isEmailValid && $isEmailAvailable ? 'is-valid' : 'is-invalid') : '' ?>"
                           id="emailInput" placeholder="email"
                           name="email" <?= isset($email) ? "value=\"$email\"" : '' ?> required>
                    <label for="emailInput">Email</label>
                    <div class="invalid-feedback">
                        <?= $isNameValid ? 'Email is already taken!' : 'Email should be like this: email@example.org' ?>
                    </div>
                    <div class="valid-feedback">
                        Nice email!
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password"
                           class="form-control <?= isset($isPasswordValid) ? ($isPasswordValid ? 'is-valid' : 'is-invalid') : '' ?>"
                           id="passwordInput"
                           placeholder="password" <?= isset($password) ? "value=\"$password\"" : '' ?>
                           name="password" required>
                    <label for="passwordInput">Password</label>
                    <div class="invalid-feedback">
                        Password must be at least 8 symbols long!
                    </div>
                    <div class="valid-feedback">
                        Nice password!
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </div>
</div>