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