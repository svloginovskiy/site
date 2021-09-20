<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="nav-link text-dark" href="/about">About</a>
                <?php if ($_SESSION['logged_in']): ?>
                <a class="btn btn-outline-dark" href="/submit">Submit</a>
                <?php endif; ?>
                <form class="d-flex ms-auto" action="/search">
                    <input class="form-control" type="search" placeholder="Search" name="q">
                </form>
                <?php if (!$_SESSION['logged_in']): ?>
                <a class="btn btn-dark ms-1" href="/login">Log in</a>
                <?php else: ?>
                <a class="btn btn-dark ms-1" href="/logout">Log out</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>
</header>