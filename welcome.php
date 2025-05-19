<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// The student number (e.g., b231210580) is stored as student_id in the session
$student_number = $_SESSION['student_id'] ?? '';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main class="container my-5">
    <div class="text-center">
        <h1 class="display-4">Welcome, <?= htmlspecialchars($student_number) ?></h1>
        <p class="lead">You have successfully logged in to the system.</p>

        <div class="card mt-5 mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h2>Account Information</h2>
                <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
                <p><strong>Student Number:</strong> <?= htmlspecialchars($student_number) ?></p>

                <div class="mt-4">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>