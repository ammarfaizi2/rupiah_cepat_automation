<?php


/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @license MIT
 */

/*

# Functions def

void login_check(array $o);
array login(array $o, string $auth_code);
array code_dispatcher(string $no);
string rstr(int $n = 32);
array tcurl(string $url, array $opt = []);

*/

$ref_id = "190210190044555523";

$handle = fopen("no.txt", "r");

if (!is_resource($handle)) {
	print "Couldn't open file!\n";
	exit(1);
}

while (!feof($handle)) {
	$no = trim(fgets($handle));
	if ($no !== "") {
		print "Dispathing code for {$no}...\n";
		$o = code_dispatcher($no);
		if (!$o["err"]) {
			$o["out"] = json_decode($o["out"], true);
			switch ($o["out"]["code"]) {
				case 400120:
					print "SMS mencapai batas harian, mohon coba lagi setelah 24 jam.\n";
					break;
				case 400141:
					print "Anda telah mendaftar untuk Rupiah cepat, tetapi sayangnya tidak dapat berpartisipasi dalam acara tersebut.\n";
					break;
				case 402001:
					print "Kode verifikasi mencapai batas harian, mohon coba lagi setelah 24 jam.\n";
					break;
				case 0:
					print "OK, enter the auth code: ";
					$auth_code = trim(fread(STDIN, 1024));
					print "Sending auth code...\n";
					
					// f(g(x))
					login_check(login($o, $auth_code));
					break;
				default:
					print "Unknown error\n";
					break;
			}
		} else {
			print "Curl error: ({$o["ern"]}) {$o["err"]}\n";
		}
		print "\n";
	}
}

fclose($handle);
print "Ended\n";

/**
 * @param array
 * @return void
 */
function login_check(array $o): void
{
	if (!$o["err"]) {
		$o["out"] = json_decode($o["out"], true);
		switch ($o["out"]["code"]) {
			case 0:
				print "Code OK!\n";
			break;
			case 400116:
				print "Kesalahan kode verifikasi\n";
			break;
			default:
				print "Unknown error\n";				
			break;
		}
	} else {
		print "Curl error: ({$o["ern"]}) {$o["err"]}\n";
	}
}


/**
 * @param string $no
 * @return array
 */
function code_dispatcher(string $no): array
{
	global $ref_id;

	$st = (string)(microtime(true) * 10000);
	$imeiHash = urlencode(date("Y-m-d H:i:s").rstr(6));
	$data = [
		"mobile" => $no,
		"noise" => "{$st}".((string)rand(10000, 99999)),
		"request_time" => "{$st}".((string)rand(0, 9)),
		"access_token" => ""
	];
	$o = tcurl("http://h5.rupiahcepatweb.com/webapi/v2/request_login_auth_code",
		[
			CURLOPT_HTTPHEADER => [
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
				"Referer: http://h5.rupiahcepatweb.com/dua2/red/red.html?invite={$ref_id}&op=0",
				"Cookie: iMeihash={$imeiHash}; _lasid=fc11f8df5592783e70eeea66695cba0c",
				"X-Requested-With: XMLHttpRequest"
			],
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query(["data" => json_encode($data)])
		]
	);
	$o["mobile"] = $no;
	$o["imei_hash"] = $imeiHash;
	$o["noise"] = $data["noise"];
	$o["request_time"] = $data["request_time"];
	return $o;
}

/**
 * @param string $no
 * @param string
 * @return array
 */
function login(array $o, string $auth_code): array
{
	global $ref_id;

	$imeiHash = $o["imei_hash"];
	$data = [
		"channel" => "",
		"mobile" => $o["mobile"],
		"auth_code" => $auth_code,
		"invite" => $ref_id,
		"op" => "0",
		"noise" => $o["noise"],
		"request_time" => $o["request_time"],
		"access_token" => ""
	];

	$o = tcurl("http://h5.rupiahcepatweb.com/webapi/v2/login", 
		[
			CURLOPT_HTTPHEADER => [
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
				"Referer: http://h5.rupiahcepatweb.com/dua2/red/red.html?invite={$ref_id}&op=0",
				"Cookie: iMeihash={$imeiHash}; _lasid=fc11f8df5592783e70eeea66695cba0c",
				"X-Requested-With: XMLHttpRequest"
			],
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query(["data" => json_encode($data)])
		]
	);

	return $o;
}


/**
 * @param int $n
 * @return string
 */
function rstr(int $n = 32): string
{
	$n = abs($n);
	$a = "qwertyuiopasdfghjklzxcvbnm12345678890QWERTYUIOPASDFGHJKLZXCVBNM";
	$r = "";
	$c = strlen($a) - 1;
	for ($i=0; $i < $n; $i++) { 
		$r .= $a[rand(0, $c)];
	}
	return $r;
}

/**
 * @param string $url
 * @param array  $opt
 * @return array
 */
function tcurl(string $url, array $opt = []): array
{
	$ch = curl_init($url);
	$opts = [
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0"
	];
	foreach ($opt as $k => $v) {
		$opts[$k] = $v;
	}
	unset($opt, $k, $v);
	curl_setopt_array($ch, $opts);
	$out = curl_exec($ch);
	$info = curl_getinfo($ch);
	$err = curl_error($ch);
	$ern = curl_errno($ch);
	curl_close($ch);
	return [
		"out" => $out,
		"info" => $info,
		"err" => $err,
		"ern" => $ern
	];
}
