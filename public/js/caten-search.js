$(document).ready(function () {
    $('#pasien_id').select2({
        placeholder: 'Cari pasien...',
        allowClear: true,
        width: '100%',
        minimumInputLength: 2,
        ajax: {
            url: pasienSearchUrl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    jenis_pasien: 'caten'
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        language: {
            noResults: function () {
                return "Pasien tidak ditemukan";
            },
            searching: function () {
                return "Mencari...";
            }
        }
    });

    const firstInput = document.querySelector('input, select, textarea');
    if (firstInput) {
        firstInput.focus();
    }
});
