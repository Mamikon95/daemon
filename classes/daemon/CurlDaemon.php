<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 07.11.2018
 * Time: 20:14
 */

namespace classes\daemon;
use classes\XORCipher;
use Curl\Curl;


class CurlDaemon {
	const DAEMON_CURL_URL = 'https://syn.su/testwork.php';
	const METHOD_GET = 'get';
	const METHOD_UPDATE = 'update';

	private static $curl_intance;

	public function __construct() {
		self::$curl_intance = new Curl();
	}

	public static function get() {
		return self::$curl_intance->post(self::DAEMON_CURL_URL,['method' => self::METHOD_GET]);
	}

	public static function update(String $key, String $message) {
		return self::$curl_intance->post(self::DAEMON_CURL_URL,['method' => self::METHOD_UPDATE, 'message' => self::_encode($key, $message)]);
	}
	
	private static function _encode(String $key, String $message) : String {
		$xor = new XORCipher();
		return base64_encode($xor->cipher($message, $key));
	}
}