<?php
// // DEFINE our cipher
define('AES_256_CBC', 'aes-256-cbc');

// // Generate a 256-bit encryption key
// // This should be stored somewhere instead of recreating it each time
// $encryption_key = openssl_random_pseudo_bytes(32);

// // Generate an initialization vector
// // This *MUST* be available for decryption as well
// $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

// // Create some data to encrypt
// $data = "Encrypt me, please!";
// echo "Before encryption: $data\n";

// // Encrypt $data using aes-256-cbc cipher with the given encryption key and
// // our initialization vector. The 0 gives us the default options, but can
// // be changed to OPENSSL_RAW_DATA or OPENSSL_ZERO_PADDING
// $encrypted = openssl_encrypt($data, AES_256_CBC, $encryption_key, 0, $iv);
// echo "Encrypted: $encrypted\n";

// // If we lose the $iv variable, we can't decrypt this, so:
// // - $encrypted is already base64-encoded from openssl_encrypt
// // - Append a separator that we know won't exist in base64, ":"
// // - And then append a base64-encoded $iv
// $encrypted = $encrypted . ':' . base64_encode($iv);

// // To decrypt, separate the encrypted data from the initialization vector ($iv).
// $parts = explode(':', $encrypted);
// $parts[0] = encrypted data
// $parts[1] = base-64 encoded initialization vector

// Don't forget to base64-decode the $iv before feeding it back to
//openssl_decrypt

$d = "4FVFhitLWzxiHgNQ6zQ9roC03Ssz27SGUHnX7oTnKr9NdyBHdGh3yNTd9yHNn4ZRKwbITQ/oDCM2X48qj182OjGWbiErjaOcLlpxe8TnBSccAex3GLlcyQoRedZtfQQCKXoxNaSO1kv6IVOfs+yMuFQvVtlS7WAhwoXi2Vjb47eFjILhumo84IzHs/h4WUaaEdaxSu45gnbdan+uxkg9+28N2GrFQ4QMUgJbjeUJNWhe2YZ7REZsMKhbHuH5tLVEcI2JHvtObla+9nf20tbe2OAKEPmct/3jwoNCwRfhTgXneje38yJQ3hPXbf0NKdIlxmtgYZt2fGEkPEoomH7PQ8Yvhp5wnJrxT+H/VJcr3O2BqIg+2v9GqbPrPVeBv0f0orHV90B85oAFgcL0cOpsdeQC0LCDsTmDK05T+aMcjWtU5kNa8FerWn7zv1Heta+apecpC8gCInzjBmwjVUfVMzq7CjM1n5VPEYj2sW6Q6dj82asoH25RWn0K4WE+MrTxzkElnmIe6dI4rXNAIUxe9g7+Yh7IdluGMdiy+rHbLOvSkcDtiB1G18iijh+Z9mtJFMQP+5hvy9nSsFtOgxdhCR/ZlZPqOhdRUVJN8tk5KEIu8JlAJaKltdFYVzCGaAvUvx7HGI4JQmm4kBI2I2i38HPoj/+5jEtlIkBiCFrgCV0UdRH3hCl1mIBFRNxZHFzfWFX8mP7hj9ag1tDRnIXYdQPN7geWaCzw/TaChrU1QmgF5b376liSXrLsTZK5/9fxIeVfJIqpmIHoaXlgmBqnEN0VDPF5i1x7upEHFl0seSczdOhZVixfPJzKQ27OGE6t";
$key = dexd("12f24fca6d6298fd1b7ff147559be43f");
$iv = dexd("b095a68b22ec1debea760810a4515505");
$decrypted = openssl_decrypt($d, AES_256_CBC, $key, 0, $iv);
var_dump($decrypted);


function dexd($s) {
	$s = str_split($s, 2);
	$r = "";
	foreach ($s as $c) {
		$r .= chr(hexdec($c));
	}
	var_dump($r);
	return $r;
}