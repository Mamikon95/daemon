<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 07.11.2018
 * Time: 20:42
 */
namespace classes;

class XORCipher {

	public function cipher($plaintext, $key) {
		$key = self::text2ascii($key);
		$plaintext = self::text2ascii($plaintext);
		$keysize = count($key);
		$input_size = count($plaintext);
		$cipher = "";

		for ($i = 0; $i < $input_size; $i++)
			$cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);
		return $cipher;
	}

	private static function text2ascii($text) {
		return array_map('ord', str_split($text));
	}
}