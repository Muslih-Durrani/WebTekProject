<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">My Personal Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resume.php">Resume</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="city.php">My City</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="heritage.php">Cultural Heritage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="interests.php">My Interests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= htmlspecialchars($_SESSION['student_id']) ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>