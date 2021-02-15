<?php

// Symmetric Encryption

// Cipher method to use for symmetric encryption
const CIPHER_METHOD = 'AES-256-CBC';

function key_encrypt($string, $key, $cipher_method=CIPHER_METHOD) {
  //return "D4RK SH4D0W RUL3Z";
  $iv_length = openssl_cipher_iv_length($cipher_method);
  $iv = openssl_random_pseudo_bytes($iv_length);

  $key = str_pad($key, 32, '*');

  $encrypted_msg = openssl_encrypt($string, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);

  $final_msg = $iv . $encrypted_msg;

  return base64_encode($final_msg); //origin: $encrypted_msg
}

function key_decrypt($string, $key, $cipher_method=CIPHER_METHOD) {
  //return "PWNED YOU!";
  $key = str_pad($key, 32, '*');

  $iv_with_cipher = base64_decode($string);
  $iv_length = openssl_cipher_iv_length($cipher_method);

  $iv = substr($iv_with_cipher, 0, $iv_length);

  $ciphertext = substr($iv_with_cipher, $iv_length);

  $final_msg = openssl_decrypt($ciphertext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);

  return $final_msg;
}


// Asymmetric Encryption / Public-Key Cryptography

// Cipher configuration to use for asymmetric encryption

//CHANGE SYNTAX SO ITS PHP 5 FRIENDLY
//origin: const PUBLIC_KEY_CONFIG = array(
define('PUBLIC_KEY_CONFIG', serialize(array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
)));
//unserialize variable
$config = unserialize(PUBLIC_KEY_CONFIG);
//origin:  function generate_keys($config=PUBLIC_KEY_CONFIG) {
function generate_keys($config) {
  // $private_key = 'Ha ha!';
  // $public_key = 'Ho ho!';

  $resource = openssl_pkey_new($config);
  openssl_pkey_export($resource, $private_key);

  $key_details = openssl_pkey_get_details($resource);
  $public_key = $key_details["key"];

  // $private_key = $keys['private'];
  // $public_key = $keys['public'];

  $keys = array('private' => $private_key, 'public' => $public_key);
  return array('private' => $keys['private'], 'public'=> $keys['public']);
}

function pkey_encrypt($string, $public_key) {
  //return 'Qnex Funqbj jvyy or jngpuvat lbh';
  //$ciphertext = base64_encode($string);
  openssl_public_encrypt($string, $encrypted_text, $public_key);
  $msg = base64_encode($encrypted_text);
  return $msg;
}

function pkey_decrypt($string, $private_key) {
  //return 'Alc evi csy pssomrk livi alir csy wlsyph fi wezmrk ETIB?';
  $ciphertext = base64_decode($string);

  openssl_private_decrypt($ciphertext, $decrypted_text, $private_key);
  return $decrypted_text;
}


// Digital signatures using public/private keys

function create_signature($data, $private_key) {
  // A-Za-z : ykMwnXKRVqheCFaxsSNDEOfzgTpYroJBmdIPitGbQUAcZuLjvlWH
  //return 'RpjJ WQL BImLcJo QLu dQv vJ oIo Iu WJu?';
  openssl_sign($data, $raw_signature, $private_key);

  $signature = base64_encode($raw_signature);
  return $signature;
}

function verify_signature($data, $signature, $public_key) {
  // Vigenère
  //return 'RK, pym oays onicvr. Iuw bkzhvbw uedf pke conll rt ZV nzxbhz.';
  $raw_signature = base64_decode($signature);
  $result = openssl_verify($data, $raw_signature, $public_key);

  return $result;
}

?>
