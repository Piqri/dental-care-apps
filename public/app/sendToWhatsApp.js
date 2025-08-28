function sendToWhatsApp(pasienName, phoneNumber, kondisiData, saranKonsultasi, saranKontrolRutin) {
    // Data kondisi gigi
    const kondisiFields = {
        'kondisi_karies': 'KARIES',
        'kondisi_sisa_akar': 'SISA AKAR',
        'kondisi_karang_gigi': 'KARANG GIGI',
        'kondisi_gusi_bengkak': 'GUSI BENGKAK',
        'kondisi_gigi_goyang': 'GIGI GOYANG',
        'kondisi_pendarahan': 'PENDARAHAN'
    };

    // Membuat pesan
    let message = "HASIL PEMERIKSAAN GIGI IBU HAMIL\n\n";
    message += `Nama: ${pasienName}\n`;
    message += `Hari/Tanggal: ${new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    })}\n\n`;

    message += "HASIL PEMERIKSAAN:\n";

    // Menambahkan kondisi gigi
    for (const [field, label] of Object.entries(kondisiFields)) {
        const exists = kondisiData[field] === true;
        message += `${label} : ${exists ? 'ADA' : 'TIDAK'}\n`;
    }

    message += "\n";

    // Menambahkan saran
    if (saranKonsultasi === 'Ya') {
        message += "Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi\n";
    }

    if (saranKontrolRutin === 'Ya') {
        message += "Disarankan untuk melakukan kontrol rutin 6x sekali\n";
    }

    // Encode message untuk URL
    const encodedMessage = encodeURIComponent(message);

    // Pastikan nomor diawali dengan 62
    phoneNumber = phoneNumber.replace(/^\+/, '');  // buang + di depan jika ada
    phoneNumber = phoneNumber.replace(/^0/, '62'); // ganti awalan 0 menjadi 62

    // Membuka WhatsApp
    window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
}
