function sendToWhatsApp(pasienName, phoneNumber, jenisPasien, kondisiData, saranKonsultasi, saranKontrolRutin, linkPemeriksaan, additionalData = {}) {
    // Data kondisi gigi untuk masing-masing jenis pasien
    const kondisiFields = {
        'anak_sekolah': {
            'kondisi_karies': 'KARIES',
            'kondisi_karang_gigi': 'KARANG GIGI',
            'kondisi_gigi_goyang': 'GIGI GOYANG',
            'kondisi_sisa_akar': 'SISA AKAR'
        },
        'caten': {
            'kondisi_karies': 'KARIES',
            'kondisi_sisa_akar': 'SISA AKAR',
            'kondisi_karang_gigi': 'KARANG GIGI',
            'kondisi_gusi_bengkak': 'GUSI BENGKAK',
            'kondisi_gigi_goyang': 'GIGI GOYANG',
            'kondisi_pendarahan': 'PENDARAHAN'
        },
        'ibu_hamil': {
            'kondisi_karies': 'KARIES',
            'kondisi_sisa_akar': 'SISA AKAR',
            'kondisi_karang_gigi': 'KARANG GIGI',
            'kondisi_gusi_bengkak': 'GUSI BENGKAK',
            'kondisi_gigi_goyang': 'GIGI GOYANG',
            'kondisi_pendarahan': 'PENDARAHAN'
        }
    };

    // Judul berdasarkan jenis pasien
    const judulPemeriksaan = {
        'anak_sekolah': 'HASIL PEMERIKSAAN GIGI ANAK SEKOLAH',
        'caten': 'HASIL PEMERIKSAAN GIGI CALON PENGANTIN',
        'ibu_hamil': 'HASIL PEMERIKSAAN GIGI IBU HAMIL'
    };

    // Membuat pesan
    let message = `${judulPemeriksaan[jenisPasien]}\n\n`;
    message += `Nama: ${pasienName}\n`;
    message += `Tanggal: ${new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    })}\n\n`;

    message += "HASIL PEMERIKSAAN:\n";

    // Menambahkan kondisi gigi sesuai jenis pasien
    const fields = kondisiFields[jenisPasien];
    for (const [field, label] of Object.entries(fields)) {
        const exists = kondisiData[field] === true;
        message += `${label} : ${exists ? 'ADA' : 'TIDAK'}\n`;
    }

    // Data tambahan khusus untuk jenis pasien tertentu
    if (jenisPasien === 'anak_sekolah' && additionalData.jumlah_gigi) {
        message += `JUMLAH GIGI : ${additionalData.jumlah_gigi.toUpperCase()}\n`;
    }

    if (jenisPasien === 'caten') {
        if (additionalData.gigi_berlubang) {
            message += `GIGI BERLUBANG : ${additionalData.gigi_berlubang}\n`;
        }
        if (additionalData.riwayat_sakit_gigi) {
            message += `RIWAYAT SAKIT GIGI : ${additionalData.riwayat_sakit_gigi}\n`;
        }
        if (additionalData.sariawan) {
            message += `SARIAWAN : ${additionalData.sariawan}\n`;
        }
    }

    if (jenisPasien === 'ibu_hamil') {
        if (additionalData.gigi_berdarah) {
            message += `GIGI BERDARAH : ${additionalData.gigi_berdarah}\n`;
        }
        if (additionalData.dikomentari_bau_mulut) {
            message += `DIKOMENTARI BAU MULUT : ${additionalData.dikomentari_bau_mulut}\n`;
        }
        if (additionalData.sulit_mengunyah) {
            message += `SULIT MENGUNYAH : ${additionalData.sulit_mengunyah}\n`;
        }
        if (additionalData.makanan_terselip) {
            message += `MAKANAN TERSELIP : ${additionalData.makanan_terselip}\n`;
        }
    }

    message += "\n";

    // Menambahkan saran
    if (saranKonsultasi === 'Ya') {
        message += "Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi\n";
    }

    if (saranKontrolRutin === 'Ya') {
        const saranKontrol = jenisPasien === 'ibu_hamil' ? 
            "Disarankan untuk melakukan kontrol rutin 6x sekali\n" :
            "Disarankan untuk melakukan kontrol rutin\n";
        message += saranKontrol;
    }

    // Tambahan untuk catatan jika ada
    if (additionalData.catatan && additionalData.catatan !== '') {
        message += `\nCATATAN:\n${additionalData.catatan}\n`;
    }

    // Tambahkan link hasil pemeriksaan
    message += `\n🔗 *LINK HASIL PEMERIKSAAN LENGKAP:*\n`;
    message += `${linkPemeriksaan}\n\n`;
    message += "Terima kasih.";

    // Encode message untuk URL
    const encodedMessage = encodeURIComponent(message);

    // Format nomor WhatsApp
    phoneNumber = phoneNumber.replace(/^\+/, '');  // Hapus + di depan
    phoneNumber = phoneNumber.replace(/^0/, '62'); // Ganti awalan 0 menjadi 62

    // Membuka WhatsApp
    window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
}