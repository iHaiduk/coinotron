<?php

require_once __DIR__ . '/coinotron.php';

try {
    if(!empty($_POST)){
	$c = new Coinotron(array(
		Coinotron::COIN_LTC
	));
	$c->login($_POST["login"], $_POST["password"]);
	$data = $c->getAccountData();

	var_dump($data);
    }
} catch (Exception $e) {
	echo $e->getMessage();
}

?>
<form action="" method="post">
    Login: <input type="text" name="login"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="submit">
</form>
