<?php
function fetchQuranSurahList() {
    $url = 'https://web-api.qurankemenag.net/quran-surah';
    $folder = __DIR__ . '/surah';

    // Buat folder jika belum ada
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-US,en;q=0.9,id-ID;q=0.8,id;q=0.7,de-DE;q=0.6,de;q=0.5',
            'Connection: keep-alive',
            'DNT: 1',
            'Origin: https://quran.kemenag.go.id',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: cross-site',
            'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            'sec-ch-ua-mobile: ?1',
            'sec-ch-ua-platform: "Android"',
            'sec-gpc: 1',
        ],
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch) . "\n";
    } else {
        $data = json_decode($response, true);
        if (isset($data['data'])) {
            file_put_contents($folder . '/surah-list.json', json_encode($data['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo "✅ Saved surah list successfully to surah/surah-list.json\n";
        } else {
            echo "No 'data' key found in response.\n";
        }
    }

    curl_close($ch);
}

fetchQuranSurahList();