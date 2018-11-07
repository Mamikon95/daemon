<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 07.11.2018
 * Time: 19:33
 */

namespace classes\daemon;

class Daemon {
	const ERROR_MAIL = 'atoyanm95@gmail.com';
	const TIME_REPEAT = 3600;

	private static $instance_curl;

	public static function init() {
		self::$instance_curl = new CurlDaemon();
		return self::_start();
	}

	private static function _start() {
		$curlGet = self::$instance_curl->get();

		do {
			$curlUpdate = self::$instance_curl->update($curlGet->response->key,$curlGet->response->message);

			if($curlUpdate->errorCode !== null || $curlUpdate->response !== 'Success') {
				self::sendErrorMail();
				break;
			}

			sleep(self::TIME_REPEAT);
		} while(true);
	}

	private static function sendErrorMail() {
		$headers = "From: admin@daemon.local";
		mail(self::ERROR_MAIL, 'Ошибка демона', 'Ошибка при получении данных.', $headers);
	}
}