<?php
session_start();

include_once (__DIR__ . '/functions.php');  //подключаем файл с функциями

if ( isset($_GET['do'] ) ){
    if ( $_GET['do'] == 'logout' ) {      //После нажатия на ссылку Выход уничтожаем все данные сессии
        session_destroy();
        session_start();                //Начинаем новую сессию
        // var_dump($_SESSION);
    }
}

if ( null !== getCurrentUser() ) {      //Если пользователь вошёл, то редирект на главную страницу
    header('Location: /index.php');
    //exit;
}else {
    if ( isset( $_POST['login'] ) ) {
        if ( isset( $_POST['password'] ) ) { //ЕСЛИ введены данные в форму входа
            if ( checkPassword($_POST['login'], $_POST['password']) ) {
                $_SESSION['username'] = $_POST['login'];  //пометили клиента
                header('Location: /index.php');
           //     exit;
            }
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
        </body>
        </html>
        <?php
        echo 'Введите логин и пароль';


?>
<br><br>
<a href="/gallery.php">Перейти в фотогалерею без авторизации<br>(Добавление фото возможно только для авторизованных пользователей)</a>