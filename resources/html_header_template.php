<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="nav-link btn btn-outline-dark" href="/submit">Submit</a>
                <?php if (!$_SESSION['logged_in']): ?>
                <a class="nav-link btn btn-dark ms-auto" href="/login">Log in</a>
                <?php else: ?>
                <a class="nav-link btn btn-dark ms-auto" href="/logout">Log out</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>
</header>