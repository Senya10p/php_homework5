<?php
session_start();

$login = $_POST['login'];
$password = $_POST['password'];
include_once (__DIR__ . '/functions.php');  //подключаем файл с функциями


if ($_GET['do'] == 'logout') {      //После нажатия на ссылку Выход уничтожаем все данные сессии
    session_destroy();
    session_start();                //Начинаем новую сессию
   // var_dump($_SESSION);
}

if (null !== getCurrentUser()){
    header('Location: /index.php');
}elseif (true === checkPassword($login, $password)) {
    $_SESSION['username'] = $_POST['login'];
    header('Location: /index.php');
}else{
    ?>
    <html>
    <head>
        <title>Авторизация</title>
    </head>
    <body>
    <h4>Авторизация</h4>
    <!--. 3. Форма входа на сайт-->
    <form action="/login.php" method="post">
        Логин: <input type="text" name="login">
        Пароль: <input type="password" name="password">
        <button type="submit">Войти</button>
    </form>
    </body>
    </html>
    <?php
      echo 'Введите логин и пароль';
}
?>
<br><br>
<a href="/gallery.php">Перейти в фотогалерею без авторизации<br>(Добавление фото возможно только для авторизованных пользователей)</a>