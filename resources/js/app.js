import './bootstrap';
import { Eye, EyeSlash } from 'phosphor-icons';

window.togglePasswordVisibility = (inputId) => {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(`${inputId}-icon`);

    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '';
        icon.appendChild(EyeSlash({ size: 24, color: '#6b7280' })); // EyeSlash icon
    } else {
        input.type = 'password';
        icon.innerHTML = '';
        icon.appendChild(Eye({ size: 24, color: '#6b7280' })); // Eye icon
    }
};

// Set initial icons
document.addEventListener('DOMContentLoaded', () => {
    const loginIcon = document.getElementById('login-password-icon');
    const registerIcon = document.getElementById('register-password-icon');

    if (loginIcon) loginIcon.appendChild(Eye({ size: 24, color: '#6b7280' }));
    if (registerIcon) registerIcon.appendChild(Eye({ size: 24, color: '#6b7280' }));
});
