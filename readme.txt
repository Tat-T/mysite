24.01.25
Установить bootstrap:
npm install bootstrap

-------------Хэширование

php > echo md5("helloword");
 необратимое шифрование:
php > echo password_hash("Hello!", PASSWORD_DEFAULT);
получаем хэш
php > echo password_verify("Hello!", 'сюда_пишем_хэш');


-------------файл hash_password.php 
в терминале D:\sites\mysite>php console/hash_password.php Hello

Хэшируем пароль из файла users.csv
D:\sites\mysite>php console/hash_password.php 123                                       
$2y$12$7CVBix2gQpYmTcjkBLsr0efkJq/YiTjFcj4WrFfstN.Ewpf0pcwzG


-------------------
http://sites/mysite/index.php?page=add




----------------------------------
#user  nobody;
worker_processes  1;

#error_log  logs/error.log;
#error_log  logs/error.log  notice;
#error_log  logs/error.log  info;

#pid        logs/nginx.pid;


events {
    worker_connections  1024;
}


http {
    include       mime.types;
    default_type  application/octet-stream;

    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
    #                  '$status $body_bytes_sent "$http_referer" '
    #                  '"$http_user_agent" "$http_x_forwarded_for"';

    #access_log  logs/access.log  main;

    sendfile        on;
    #tcp_nopush     on;

    #keepalive_timeout  0;
    keepalive_timeout  65;

    #gzip  on;

    server {
        listen       80;
        server_name  localhost;
        root         D:\sites;

        #charset koi8-r;

        #access_log  logs/host.access.log  main;

        # location / {
        #     root   html;
        #     index  index.html index.htm;
        # }

        # Обработка статических файлов
        location ~* \.(jpg|jpeg|gif|png|svg|css|js|ico|woff|woff2|ttf|eot)$ {
        try_files $uri $uri/ =404;
        expires 30d;
        access_log off;
        }

        #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        location ~\.php$ {
            fastcgi_pass 127.0.0.1:9123;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
        #
        #location ~ \.php$ {
        #    proxy_pass   http://127.0.0.1;
        #}

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        #location ~ \.php$ {
        #    root           html;
        #    fastcgi_pass   127.0.0.1:9000;
        #    fastcgi_index  index.php;
        #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
        #    include        fastcgi_params;
        #}

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }


    # another virtual host using mix of IP-, name-, and port-based configuration
    #
    #server {
    #    listen       8000;
    #    listen       somename:8080;
    #    server_name  somename  alias  another.alias;

    #    location / {
    #        root   html;
    #        index  index.html index.htm;
    #    }
    #}


    # HTTPS server
    #
    #server {
    #    listen       443 ssl;
    #    server_name  localhost;

    #    ssl_certificate      cert.pem;
    #    ssl_certificate_key  cert.key;

    #    ssl_session_cache    shared:SSL:1m;
    #    ssl_session_timeout  5m;

    #    ssl_ciphers  HIGH:!aNULL:!MD5;
    #    ssl_prefer_server_ciphers  on;

    #    location / {
    #        root   html;
    #        index  index.html index.htm;
    #    }
    #}

}


-----------------
<?php
// $host = '127.0.0.1';
// $db = 'first';
// $user = 'root';
// $password = '123456780';

$user = ""; // Если используется Windows-аутентификация (Trusted_Connection)
$password = "";

$dsn = "sqlsrv:Server=DESKTOP-NKNKVEQ\\SQLEXPRESS;Database=first;TrustServerCertificate=True";
$pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$username = $_GET['username'];
$query = "SELECT * FROM [User] WHERE [User] = :username";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();

while ($row = $stmt->fetch()){
    echo $row['User'] . ' ' . $row['password'] . "\n";
}
------------------------------------------------------------
Вывод в терминал таблицы из БД

D:\sites\mysite\core>php Database.php

ID | Username | Password
-------------------------
1 | user1 | 123
2 | user2 | 456
3 | user3 | 4455

-------------код для вывода в консоль Database.php
(версия преподавателя)
<?php
// Настройки подключения
$user = ""; // Если используется Windows-аутентификация (Trusted_Connection)
$password = "";

$dsn = "sqlsrv:Server=DESKTOP-NKNKVEQ\\SQLEXPRESS;Database=first;TrustServerCertificate=True";

try {
    // Подключение к базе данных
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // SQL-запрос для выбора 1000 записей из таблицы [User]
    $sql = "SELECT TOP (1000) [id], [User], [password] FROM [dbo].[User]";
    
    // Подготовка и выполнение запроса
    $stmt = $pdo->query($sql);

    // Вывод заголовка таблицы
    echo "ID | Username | Password\n";
    echo "-------------------------\n";

    // Вывод данных в консоль
    while ($row = $stmt->fetch()) {
        echo "{$row['id']} | {$row['User']} | {$row['password']}\n";
    }
    
} catch (PDOException $e) {
    // Обработка ошибок
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
--------------------------12.02.25----------------------------
https://phpfaq.ru/pdo Как работать с PDO? Полное руководство.

Composer — это инструмент для управления сторонними библиотеками в PHP-проекте. 
Установка composer https://getcomposer.org/download/

--------------------------14.02.25----------------------------

использование Faker в терминале:
D:\sites\mysite\console>php seeder.php
Ms. Serena Pfeffer III
---------------------------
в корне проекта в терминале (cmd)
composer require vlucas/phpdotenv 
composer require doctrine/orm doctrine/dbal
composer require doctrine/orm doctrine/dbal symfony/cache

если D:\sites\mysite>php bootstrap.php без ошибок установка прошла успешно composer require doctrine/orm doctrine/dbal
composer require doctrine/orm doctrine/dbal symfony/cache
----------------------------17.02.25----------------------------------

Настройки БД для доктрины: (файл "Настройка для Доктрины SSMS.txt")

1 Разрешить соединения через именованные каналы

2 Включить стандартный порт 1433 (для SQL Server)

3 Разрешить SQL Server работать через брандмауэр

4 Включите смешанный режим  работы SQL Server (SQL Server + Windows Authentication):

5 Создать пользователя в Microsoft SQL Server Management Studio (SSMS) и дать ему права на базу данных first

-----------------------------19.02.25----------------------------------

D:\sites\mysite>composer require symfony/validator 