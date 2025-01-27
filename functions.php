<?php

function openUsers(string $mode) {
    $fd = @fopen(__DIR__ . '/users.csv', $mode) or die('Нет запрашиваемого вами файла!');
    return $fd;
}

function readUsers() 
{
    $users =[];
    $fd = openUsers('r');
    while(!feof($fd)) {
    $user = fgets($fd);
    if ($user) {
        $user = rtrim($user);
        $users[] = explode(',', $user);
        }
    }
    fclose($fd);
    return $users;
}

function addUser($login, $password, $email){
    $users = readUsers('r');
    if (in_array($login, array_column($users, 0)) || in_array($email, array_column($users, 2))) {
        die('пользователь с такими учётными данными уже зарегистрирован!');
    }
    $fd = openUsers('a');
    fputcsv(stream: $fd, fields: [$login, $password, $email], escape: "\\");
    fclose($fd);
}
