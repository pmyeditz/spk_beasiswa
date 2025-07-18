
    // Tentukan ID field nama: bisa 'nama_admin' (admin) atau 'nama' (guru)
    const nameFieldId = document.getElementById('nama_admin') ? 'nama_admin' : 'nama';
    const emailFieldId = 'email';

    // Simpan nilai awal untuk reset
    const initialValues = {
        [nameFieldId]: document.getElementById(nameFieldId).value,
        [emailFieldId]: document.getElementById(emailFieldId).value,
    };

    // Fungsi aktifkan input (hapus readonly)
    function enableField(fieldId) {
        const input = document.getElementById(fieldId);
        input.removeAttribute('readonly');
        input.focus();
        document.getElementById('cancelBtn').style.display = 'inline-block';
    }

    // Tampilkan/Sembunyikan kolom password
    function togglePasswordFields() {
        const pwFields = document.getElementById('passwordFields');
        pwFields.style.display = pwFields.style.display === 'none' ? 'block' : 'none';
        document.getElementById('cancelBtn').style.display = 'inline-block';
    }

    // Batal edit, reset semua input
    function cancelEdit() {
        [nameFieldId, emailFieldId].forEach(fieldId => {
            const input = document.getElementById(fieldId);
            input.value = initialValues[fieldId];
            input.setAttribute('readonly', true);
        });

        // Sembunyikan password fields
        document.getElementById('passwordFields').style.display = 'none';
        document.getElementById('cancelBtn').style.display = 'none';

        // Kosongkan password
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';
    }

    // Toggle visibilitas password
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

    // Saat halaman selesai dimuat
    window.onload = () => {
        document.getElementById('cancelBtn').style.display = 'none';
    };

