<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: welcome.php');
    exit;
}

// Process form submission
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    $errors = [];
    
    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors['username'] = 'Username must be a valid email address';
    } else {
        // Validate Sakarya University email format
        $emailParts = explode('@', $username);
        if (count($emailParts) !== 2 || $emailParts[1] !== 'sakarya.edu.tr') {
            $errors['username'] = 'Only sakarya.edu.tr emails are allowed';
        } else {
            // Validate student number format (any letter followed by 9 digits)
            $studentNumber = $emailParts[0];
            if (!preg_match('/^[a-zA-Z]\d{9}$/', $studentNumber)) {
                $errors['username'] = 'Invalid student number format (must be a letter followed by 9 digits)';
            }
        }
    }
    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } else {
        // Validate password format (should match username before @)
        $emailParts = explode('@', $username);
        if (count($emailParts) === 2 && $password !== $emailParts[0]) {
            $errors['password'] = 'Password must match your student number (a letter followed by 9 digits)';
        }
    }
    
    // If no errors, proceed with login
    if (empty($errors)) {
        // Extract student number from email
        $studentNumber = explode('@', $username)[0];
        
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['student_id'] = $studentNumber; 
        
        // Redirect to welcome page
        header('Location: welcome.php');
        exit;
    }
}
?>

<?php include 'includes/header.php'; ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    
                    <?php if (isset($errors['login'])): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($errors['login']) ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="login.php" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="email" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
                                   id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required
                                   placeholder="b123456789@sakarya.edu.tr">
                            <?php if (isset($errors['username'])): ?>
                                <div class="invalid-feedback"><?= htmlspecialchars($errors['username']) ?></div>
                            <?php endif; ?>
                            <small class="text-muted">Use your Sakarya University email</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                                   id="password" name="password" required
                                   placeholder="b123456789">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
                            <?php endif; ?>
                            <small class="text-muted">Your password is your student number (a letter followed by 9 digits)</small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Enhanced client-side validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        
        // Reset previous errors
        username.classList.remove('is-invalid');
        password.classList.remove('is-invalid');
        
        // Validate username (email format and sakarya.edu.tr domain)
        if (!username.value.trim()) {
            username.classList.add('is-invalid');
            username.nextElementSibling.textContent = 'Username is required';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(username.value)) {
            username.classList.add('is-invalid');
            username.nextElementSibling.textContent = 'Username must be a valid email address';
            isValid = false;
        } else {
            const emailParts = username.value.split('@');
            if (emailParts.length !== 2 || emailParts[1] !== 'sakarya.edu.tr') {
                username.classList.add('is-invalid');
                username.nextElementSibling.textContent = 'Only sakarya.edu.tr emails are allowed';
                isValid = false;
            } else if (!/^[a-zA-Z]\d{9}$/.test(emailParts[0])) {
                username.classList.add('is-invalid');
                username.nextElementSibling.textContent = 'Invalid student number format (must be a letter followed by 9 digits)';
                isValid = false;
            }
        }
        
        // Validate password (not empty and matches username prefix)
        if (!password.value.trim()) {
            password.classList.add('is-invalid');
            password.nextElementSibling.textContent = 'Password is required';
            isValid = false;
        } else {
            const emailParts = username.value.split('@');
            if (emailParts.length === 2 && password.value !== emailParts[0]) {
                password.classList.add('is-invalid');
                password.nextElementSibling.textContent = 'Password must match your student number';
                isValid = false;
            }
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>