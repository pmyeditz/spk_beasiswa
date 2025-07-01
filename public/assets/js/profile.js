const initialValues = {
    nama_admin: document.getElementById('nama_admin').value,
    email: document.getElementById('email').value,
};

function enableField(fieldId) {
    const input = document.getElementById(fieldId);
    input.removeAttribute('readonly');
    input.focus();
    document.getElementById('cancelBtn').style.display = 'inline-block';
}

function togglePasswordFields() {
    const pwFields = document.getElementById('passwordFields');
    pwFields.style.display = pwFields.style.display === 'none' ? 'block' : 'none';
    document.getElementById('cancelBtn').style.display = 'inline-block';
}

function cancelEdit() {
    ['nama_admin', 'email'].forEach(fieldId => {
        const input = document.getElementById(fieldId);
        input.value = initialValues[fieldId];
        input.setAttribute('readonly', true);
    });

    document.getElementById('passwordFields').style.display = 'none';
    document.getElementById('cancelBtn').style.display = 'none';

    document.getElementById('password').value = '';
    document.getElementById('password_confirmation').value = '';
}

function toggleVisibility(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById('eye-' + id);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

window.onload = () => {
    document.getElementById('cancelBtn').style.display = 'none';
}
