<?php

// Jumlah ayat tiap surat (114 surat)
$jumlahAyat = [
    7, 286, 200, 176, 120, 165, 206, 75, 129, 109,
    123, 111, 43, 52, 99, 128, 111, 110, 98, 135,
    112, 78, 118, 64, 77, 227, 93, 88, 69, 60,
    34, 30, 73, 54, 45, 83, 182, 88, 75, 85,
    54, 53, 89, 59, 37, 35, 38, 29, 18, 45,
    60, 49, 62, 55, 78, 96, 29, 22, 24, 13,
    14, 11, 11, 18, 12, 12, 30, 52, 52, 44,
    28, 28, 20, 56, 40, 31, 50, 40, 46, 42,
    29, 19, 36, 25, 22, 17, 19, 26, 30, 20,
    15, 21, 11, 8, 8, 19, 5, 8, 8, 11,
    11, 8, 3, 9, 5, 4, 7, 3, 6, 3,
    5, 4, 5, 6
];

// URL base
$baseUrl = "https://media.qurankemenag.net/audio/Abu_Bakr_Ash-Shaatree_aac64/";

// Folder dasar
$baseFolder = "audio_quran/";
if (!file_exists($baseFolder)) {
    mkdir($baseFolder, 0777, true);
}

// Loop surat
for ($surat = 1; $surat <= 114; $surat++) {
    $suratStr = str_pad($surat, 3, '0', STR_PAD_LEFT);
    $ayatCount = $jumlahAyat[$surat - 1];

    // Buat folder berdasarkan nomor surat
    $suratFolder = $baseFolder . $suratStr . "/";
    if (!file_exists($suratFolder)) {
        mkdir($suratFolder, 0777, true);
    }

    // Loop ayat
    for ($ayat = 1; $ayat <= $ayatCount; $ayat++) {
        $ayatStr = str_pad($ayat, 3, '0', STR_PAD_LEFT);
        $fileName = $suratStr . $ayatStr . ".m4a";
        $url = $baseUrl . $fileName;

        $localFile = $suratFolder . $fileName;
        echo "Mengunduh: $fileName ke $suratFolder ... ";

        $content = @file_get_contents($url);
        if ($content !== false) {
            file_put_contents($localFile, $content);
            echo "berhasil.\n";
        } else {
            echo "gagal.\n";
        }

        // Hindari request terlalu cepat
        usleep(300000); // 0.3 detik
    }
}

echo "✅ Semua audio berhasil diunduh dan disimpan terstruktur.\n";
?>
