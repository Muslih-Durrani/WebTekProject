document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    const validateBtn = document.getElementById('validateBtn');

    if (form) {
        // Reset validation on form reset
        form.addEventListener('reset', function () {
            const inputs = form.querySelectorAll('.is-invalid');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
        });

        // Validate individual fields on blur
        form.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('blur', function () {
                validateField(this);
            });
        });

        // Validate button click handler
        if (validateBtn) {
            validateBtn.addEventListener('click', function (e) {
                e.preventDefault();
                let isValid = true;

                // Validate all fields
                form.querySelectorAll('[required]').forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                // Special validation for phone
                const phone = document.getElementById('phone');
                if (phone.value && !/^[0-9]{10,15}$/.test(phone.value)) {
                    phone.classList.add('is-invalid');
                    phone.nextElementSibling.textContent = 'Phone must be 10-15 digits';
                    isValid = false;
                }

                if (isValid) {
                    alert('All form fields are valid!');
                } else {
                    alert('Please fix the errors in the form.');
                }
            });
        }

        // Form submission handler
        form.addEventListener('submit', function (e) {
            let isValid = true;

            // Validate all required fields
            form.querySelectorAll('[required]').forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                }
            });

            // Validate phone if provided
            const phone = document.getElementById('phone');
            if (phone.value && !/^[0-9]{10,15}$/.test(phone.value)) {
                phone.classList.add('is-invalid');
                phone.nextElementSibling.textContent = 'Phone must be 10-15 digits';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fix the errors in the form before submitting.');
            }
        });
    }

    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;

        // Reset validation
        field.classList.remove('is-invalid');

        // Check if required field is empty
        if (field.required && !value) {
            field.classList.add('is-invalid');
            field.nextElementSibling.textContent = 'This field is required';
            isValid = false;
        }

        // Additional validation for email
        if (field.type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            field.classList.add('is-invalid');
            field.nextElementSibling.textContent = 'Please enter a valid email address';
            isValid = false;
        }

        return isValid;
    }
});