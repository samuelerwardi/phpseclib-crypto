<?php
// require __DIR__ . '/vendor/autoload.php';


//     include 'Crypt/TripleDES.php';

//     $des = new Crypt_TripleDES(CRYPT_DES_MODE_ECB);

//     $des->setKey('3A7A616F48A944A5');
//     $plaintext["ID_No"] = "00000111112222";
//     $plaintext["Name"] = "ANDY TAN";
//     $plaintext = json_encode($plaintext);

//     // $plaintext = 'samuel';
//     $chiper_encode = base64_encode($des->encrypt($plaintext));
//     echo $chiper_encode;
//     echo "<br>";
//     echo $des->decrypt(base64_decode($chiper_encode));

function encrypt($data, $secret)
{
	//Generate a key from a hash
	$key = $secret;

	//Take first 8 bytes of $key and append them to the end of $key.
	$key .= substr($key, 0, 8);

	//Pad for PKCS7
	$blockSize = mcrypt_get_block_size('tripledes', 'ecb');
	$len = strlen($data);
	$pad = $blockSize - ($len % $blockSize);
	$data .= str_repeat(chr($pad), $pad);

	//Encrypt data
	$encData = mcrypt_encrypt('tripledes', $key, $data, 'ecb');

	return base64_encode($encData);
}
$key = "3A7A616F48A944A5";
$plaintext["ID_No"] = "00000111112222";
$plaintext["Name"] = "ANDY TAN";
$plaintext = json_encode($plaintext);
// $plaintext = "Hello"; 
echo "The string: ".$plaintext;
echo "<br>";
echo encrypt($plaintext,$key);

?>