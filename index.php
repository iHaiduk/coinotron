<?php

require_once __DIR__ . '/coinotron.php';

try {
	$c = new Coinotron(array(
		Coinotron::COIN_LTC,
		Coinotron::COIN_FTC
	));
	$c->login('user', 'pass');
	$data = $c->getAccountData();

	var_dump($data);
} catch (Exception $e) {
	echo $e->getMessage();
}
