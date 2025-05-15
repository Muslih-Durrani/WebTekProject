<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main class="container my-5">
    <h1 class="display-4 text-center mb-5">Contact Me</h1>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <form id="contactForm" method="post" action="form-submit.php" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10,15}">
                            <div class="invalid-feedback">Please enter a valid phone number (digits only, 10-15
                                characters).</div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="" selected disabled>Choose a subject</option>
                                <option value="question">Question</option>
                                <option value="feedback">Feedback</option>
                                <option value="suggestion">Suggestion</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select a subject.</div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">Please enter your message.</div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">Subscribe to newsletter</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Clear Form</button>
                            <div>
                                <button type="button" id="validateBtn" class="btn btn-primary me-2">Validate
                                    Form</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="assets/js/form-validation.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Using Vue.js for validation (alternative to the pure JavaScript version)
        const contactForm = new Vue({
            el: '#contactForm',
            data: {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: '',
                newsletter: false,
                errors: {}
            },
            methods: {
                validateForm: function () {
                    this.errors = {};

                    // Name validation
                    if (!this.name.trim()) {
                        this.errors.name = 'Name is required';
                    }

                    // Email validation
                    if (!this.email.trim()) {
                        this.errors.email = 'Email is required';
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) {
                        this.errors.email = 'Please enter a valid email address';
                    }

                    // Phone validation
                    if (this.phone && !/^[0-9]{10,15}$/.test(this.phone)) {
                        this.errors.phone = 'Phone must be 10-15 digits';
                    }

                    // Subject validation
                    if (!this.subject) {
                        this.errors.subject = 'Subject is required';
                    }

                    // Message validation
                    if (!this.message.trim()) {
                        this.errors.message = 'Message is required';
                    }

                    // Highlight fields with errors
                    Object.keys(this.errors).forEach(field => {
                        const input = document.getElementById(field);
                        if (input) {
                            input.classList.add('is-invalid');
                        }
                    });

                    // Return true if no errors
                    return Object.keys(this.errors).length === 0;
                },
                resetValidation: function () {
                    this.errors = {};
                    ['name', 'email', 'phone', 'subject', 'message'].forEach(field => {
                        const input = document.getElementById(field);
                        if (input) {
                            input.classList.remove('is-invalid');
                        }
                    });
                },
                submitForm: function () {
                    if (this.validateForm()) {
                        // Form is valid, proceed with submission
                        document.getElementById('contactForm').submit();
                    }
                }
            }
        });

        // Add event listeners for the buttons
        document.getElementById('validateBtn').addEventListener('click', function () {
            contactForm.validateForm();
            if (Object.keys(contactForm.errors).length === 0) {
                alert('Form validation successful! All fields are valid.');
            } else {
                alert('Please fix the errors in the form.');
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>