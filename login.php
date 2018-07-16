<?php
session_start();

include_once (__DIR__ . '/functions.php');  //подключаем файл с функциями

if ( null !== getCurrentUser() ) {      //Если пользователь вошёл, то редирект на главную страницу
    header('Location: /index.php');
    exit;
}

if ( isset( $_POST['login'] ) ) {
    if ( isset( $_POST['password'] ) ) { //Если введены данные в форму входа
        if ( checkPassword( $_POST['login'], $_POST['password'] ) ) {
            $_SESSION['username'] = $_POST['login'];  //помечаем клиента
            header('Location: /index.php');
            exit;
        }
    }
}

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
        <p>Введите логин и пароль</p>
        <br>
        <a href="/gallery.php">Перейти в фотогалерею без авторизации<br>
        (Добавление фото возможно только для авторизованных пользователей)</a>
    </body>
</html>