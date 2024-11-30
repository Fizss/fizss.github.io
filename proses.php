<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan teks dari formulir
    $teks = $_POST['teks'];
    
    // Fungsi untuk mengonversi teks ke kode biner
    function teks_ke_biner($teks) {
        $biner = '';
        for ($i = 0; $i < strlen($teks); $i++) {
            $biner .= sprintf("%08b", ord($teks[$i]));
        }
        return $biner;
    }

    // Mengonversi teks ke kode biner
    $kode_biner = teks_ke_biner($teks);

    // Menggunakan API Pastebin untuk memposting kode biner
    $api_dev_key = 'cArUHRYUoeEps55NXKuIw9xWibcx7c31';
    $api_paste_code = urlencode($kode_biner);
    $api_paste_private = '1';
    $api_paste_name = 'Konversi Teks ke Biner';
    $api_paste_expire_date = '10M';
    $api_paste_format = 'text';
    $api_user_key = ''; // Jika Anda memiliki api_user_key, tambahkan di sini

    $url = 'https://pastebin.com/api/api_post.php';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key=' . $api_user_key . '&api_paste_private=' . $api_paste_private . '&api_paste_name=' . urlencode($api_paste_name) . '&api_paste_expire_date=' . $api_paste_expire_date . '&api_paste_format=' . $api_paste_format . '&api_dev_key=' . $api_dev_key . '&api_paste_code=' . $api_paste_code);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    // Redirect ke URL Pastebin yang dibuat
    header("Location: " . $response);
    exit();
}
?>
