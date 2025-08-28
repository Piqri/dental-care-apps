document.addEventListener('DOMContentLoaded', function () {
    const jenisPasienSelect  = document.getElementById('jenis_pasien');
    const formContainer      = document.getElementById('formContainer');
    const jenisKelaminSelect = document.getElementById('jenis_kelamin');
    const form               = document.getElementById('pasienForm');

    function showFields(value) {
        // Hide and DISABLE all jenis-pasien fields
        document.querySelectorAll('.jenis-pasien-fields').forEach(f => {
            f.classList.add('hidden');
            f.querySelectorAll('input, select, textarea').forEach(el => {
                el.disabled = true;
            });
        });

        // Remove any previous hidden input of jenis_kelamin
        document
            .querySelectorAll('input[name="jenis_kelamin"][type="hidden"]')
            .forEach(e => e.remove());

        if (!value) {
            formContainer.style.display = 'none';
            return;
        }

        formContainer.style.display = 'block';

        // Show and ENABLE selected group
        const activeFields = document.getElementById(value + '_fields');
        activeFields.classList.remove('hidden');
        activeFields.querySelectorAll('input, select, textarea').forEach(el => {
            el.disabled = false;
        });

        // khusus ibu_hamil -> kunci jenis_kelamin
        if (value === 'ibu_hamil') {
            jenisKelaminSelect.value = 'Perempuan';
            jenisKelaminSelect.disabled = true;

            const hiddenInput = document.createElement('input');
            hiddenInput.type  = 'hidden';
            hiddenInput.name  = 'jenis_kelamin';
            hiddenInput.value = 'Perempuan';
            activeFields.appendChild(hiddenInput);
        } else {
            jenisKelaminSelect.disabled = false;
        }
    }

    if (jenisPasienSelect) {
        jenisPasienSelect.addEventListener('change', function () {
            showFields(this.value);
        });

        // Inisialisasi (jika old value ada)
        if (jenisPasienSelect.value) {
            showFields(jenisPasienSelect.value);
        }
    }

    // Extra client validation
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;

            // General
            ['nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir'].forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.value) {
                    el.classList.add('border-red-500');
                    isValid = false;
                } else if (el) {
                    el.classList.remove('border-red-500');
                }
            });

            // Specific (hanya input yang ENABLED)
            document.querySelectorAll('.jenis-pasien-fields input:not([disabled]), .jenis-pasien-fields textarea:not([disabled])')
                .forEach(el => {
                    if (!el.value) {
                        el.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        el.classList.remove('border-red-500');
                    }
                });

            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    }
});
