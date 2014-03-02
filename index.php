<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 01.03.14
 * Time: 13:51
 */

function login($url,$login,$pass){
    $ch = curl_init();
    if(strtolower((substr($url,0,5))=='https')) { // если соединяемся с https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    // откуда пришли на эту страницу
    curl_setopt($ch, CURLOPT_REFERER, $url);
    // cURL будет выводить подробные сообщения о всех производимых действиях
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"login=".$login."&pass=".$pass);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //сохранять полученные COOKIE в файл
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__.'/cookie.txt');
    $result=curl_exec($ch);

    // Убеждаемся что произошло перенаправление после авторизации
    //if(strpos($result,"Location: coinotron.com")===false) die('Login incorrect');

    curl_close($ch);

    return $result;
}

// чтение страницы после авторизации
function Read($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // откуда пришли на эту страницу
    curl_setopt($ch, CURLOPT_REFERER, $url);
    //запрещаем делать запрос с помощью POST и соответственно разрешаем с помощью GET
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //отсылаем серверу COOKIE полученные от него при авторизации
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookie.txt');
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}

var_dump(login("https://coinotron.com/coinotron/AccountServlet?action=logon",'user', 'pass'));
var_dump(Read("https://coinotron.com/coinotron/AccountServlet?action=home")); die();
