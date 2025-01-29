<?php
$sapi_name = php_sapi_name();

//Проверка sapi в консоли
//fwrite(STDOUT, $sapi_name . PHP_EOL);

if ($sapi_name != 'cli')
{
    return;
}

//Проверка аргументов скрипта
//fwrite(STDOUT, implode(', ', $argv) . PHP_EOL);

$passw = $argv[1] ?? '';
if ($passw == '') {
    fwrite(STDOUT, 'Использование: php hash_password.php ПАРОЛЬ' . PHP_EOL);
}
fwrite(STDOUT, password_hash(trim($passw), PASSWORD_DEFAULT) . PHP_EOL);