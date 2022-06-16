<?php
    include SITE_ROOT . "/app/database/db.php";

    $errMsg = '';

    function userAuth($user)
    {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nickname'] = $user['nickname'];
        $_SESSION['admin'] = $user['admin'];

        if ($_SESSION['admin']) {
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        } else {
            header('location: ' . BASE_URL);
        }
    }

    //Код для регистрации
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
        $admin = 0;
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $passF = trim($_POST['first_pass']);
        $passS = trim($_POST['second_pass']);

        if ($login === '' || $email === '' || $passF === '') {
            $errMsg = "<p>Не все поля заполнены!</p>";
        } elseif (mb_strlen($login, 'UTF8') < 2) {
            $errMsg = "<p>Никнейм должен быть более 2-х символов</p>";
        } elseif ($passF !== $passS) {
            $errMsg = "<p>Пароли должны совпадать</p>";
        } else {
            $existence = selectOne('users', ['email' => $email]);
            if (!empty($existence['email']) && $existence['email'] === $email) {
                $errMsg = "<p>Пользователь с такой почтой уже зарегистрирован!</p>";
            } else {
                $pass = password_hash($passF, PASSWORD_DEFAULT);
                $post = [
                    'admin' => $admin,
                    'nickname' => $login,
                    'email' => $email,
                    'password' => $pass
                ];
                $id = insert('users', $post);
                $errMsg = "<p class = 'sucess'>Пользователь <strong>" . $login . "</strong> успешно зарегистрирован!</p>";

                $user = selectOne('users', ['id' => $id]);
                userAuth($user);
            }
        }
    } else {
        $login = '';
        $email = '';
    }

    //Код для авторизации
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {

        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);

        if ($email === '' || $pass === '') {
            $errMsg = "<p>Не все поля заполнены!</p>";
        } else {
            $existence = selectOne('users', ['email' => $email]);
            if ($existence && password_verify($pass, $existence['password'])) {
                //Авторизовать
                userAuth($existence);
            } else {
                //Ошибка авторизации
                $errMsg = "<p>Почта или пароль введены не верно!</p>";
            }
        }
    } else {
        $login = '';
    }
