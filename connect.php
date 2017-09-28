<?
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "mysql"; // имя пользователя (в Denwer`е по умолчанию "root")
$password = "mysql"; // пароль пользователя (в Denwer`е по умолчанию пароль отсутствует, этот параметр можно оставить пустым)
$dbName = "test1"; // название базы данных

/* Создаем соединение */
mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
mysql_query('SET NAMES utf8') or header('Location: Error');

/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die (mysql_error());
?>