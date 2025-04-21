document.addEventListener('DOMContentLoaded', function () {

    const passInput = document.getElementById('pass');
    const passConfirmInput = document.getElementById('pass_r');

    const passInputE = document.getElementById('pass_e');
    const passConfirmInputE = document.getElementById('pass_er');

    const passwordMatchMessage = document.getElementById('passwordMatchMessage');
    const strengthBar = document.getElementById('strength-bar');
    const strengthMessage = document.getElementById('passwordStrengthMessage');

    if (passInput && passConfirmInput) {
        passConfirmInput.addEventListener('input', function () {
            checkPasswords(passInput, passConfirmInput);
        });
        passInput.addEventListener('input', function () {
            checkPasswordStrength(passInput);
        });
    }

    // Comprobación para formulario de edición
    if (passInputE && passConfirmInputE) {
        passConfirmInputE.addEventListener('input', function () {
            checkPasswords(passInputE, passConfirmInputE);
        });
        passInputE.addEventListener('input', function () {
            checkPasswordStrength(passInputE);
        });
    }

    function checkPasswords(input, confirmInput) {
        if (!passwordMatchMessage) return;

        if (input.value !== confirmInput.value) {
            passwordMatchMessage.style.display = 'block';
        } else {
            passwordMatchMessage.style.display = 'none';
        }
    }

    function checkPasswordStrength(input) {
        if (!strengthBar || !strengthMessage) return;

        const password = input.value;
        let strength = 0;

        if (password.length >= 6) strength += 1; 
        if (/[A-Z]/.test(password)) strength += 1; 
        if (/[a-z]/.test(password)) strength += 1; 
        if (/[0-9]/.test(password)) strength += 1; 
        if (/[^A-Za-z0-9]/.test(password)) strength += 1; 

        updateStrengthBar(strength);
    }

    function updateStrengthBar(strength) {
        let color = 'red';
        let width = '20%';
        let message = 'Contraseña muy débil';

        switch (strength) {
            case 1:
                color = 'orange';
                width = '40%';
                message = 'Contraseña débil';
                break;
            case 2:
                color = 'yellow';
                width = '60%';
                message = 'Contraseña aceptable';
                break;
            case 3:
                color = 'lightgreen';
                width = '80%';
                message = 'Contraseña buena';
                break;
            case 4:
                color = 'green';
                width = '100%';
                message = 'Contraseña fuerte';
                break;
        }

        strengthBar.style.width = width;
        strengthBar.style.backgroundColor = color;
        strengthMessage.textContent = message;
    }
});
