<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark py-3 px-4">
    <a class="navbar-brand" href="?home=true">📚LMS59</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="?home=true">Home</a>
            </li>
            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['userType'] == 'user'): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="?notes=true">Notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?saved=true">Saved</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?upload=true">Upload</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-danger" href="?logout=true">Logout</a>
                </li>
            <?php elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['userType'] == 'admin'): ?>
                <li class="nav-item active">
                    <a class="nav-link text-primary" href="?dashboard=true">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-danger" href="?logout=true">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link text-success" href="?login=true">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-success" href="?register=true">Register</a>
                </li>
            <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION['isLoggedIn'])): ?>
            <form class="form-inline mt-2 d-flex gap-3 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search Notes" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        <?php else: ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-primary" href="?adminLogin=true">Admin Login</a>
                </li>
            </ul>
        <?php endif; ?>

    </div>
</nav>