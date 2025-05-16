<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// Process form data
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$subject = htmlspecialchars($_POST['subject'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');
$newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Form Submission Received</h1>

                    <div class="alert alert-success">
                        <p class="mb-0">Thank you for your submission! We'll get back to you soon.</p>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h2>Your Submission Details</h2>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Name:</dt>
                                <dd class="col-sm-9"><?= $name ?></dd>

                                <dt class="col-sm-3">Email:</dt>
                                <dd class="col-sm-9"><?= $email ?></dd>

                                <dt class="col-sm-3">Phone:</dt>
                                <dd class="col-sm-9"><?= $phone ? $phone : 'Not provided' ?></dd>

                                <dt class="col-sm-3">Subject:</dt>
                                <dd class="col-sm-9"><?= $subject ?></dd>

                                <dt class="col-sm-3">Message:</dt>
                                <dd class="col-sm-9"><?= $message ?></dd>

                                <dt class="col-sm-3">Newsletter:</dt>
                                <dd class="col-sm-9"><?= $newsletter ?></dd>
                            </dl>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="index.php" class="btn btn-primary">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>