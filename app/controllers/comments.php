<?php
    //на single.php иклюдить в комментарий include "app/include/comment.php";
    //Контроллер
    include_once SITE_ROOT . "/app/database/db.php";
    $commentsForAdm = selectAll('comments');
    $page = $_GET['post'];
    $email = '';
    $comment = '';
    $errMsg = [];
    $status = 0;
    $comments = [];

    //Код для создания комментария
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

        $email = trim($_POST['email']);
        $comment = trim($_POST['comment']);

        if ($email === '' || $comment === '') {
            array_push($errMsg, "<p>Не все поля заполнены!</p>");
        } elseif (mb_strlen($comment, 'UTF8') < 50) {
            array_push($errMsg, "<p>Комментарий должен быть длиннее 50-ти символов!</p>");
        } else {
            $user = selectOne('users', ['email' => $email]);
            if($user['email'] == $email){
                $status = 1;
            }

            $comment = [
                'status' => $status,
                'page' => $page,
                'email' => $email,
                'comment' => $comment
            ];

            $comment = insert('comments', $comment);
            $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
        }
    } else {
        $email = '';
        $comment = '';
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
    }

    //Удаление комментария
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];  
        delete('comments', $id);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }

    //Publish, unpublish
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
        $id = $_GET['pub_id'];  
        $publish = $_GET['publish'];
        $postId = update('comments', $id, ['status' => $publish]);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }

    //Редактирование комментария
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $oneComment = selectOne('comments', ['id' => $_GET['id']]);
        $id = $oneComment['id'];
        $email = $oneComment['email'];
        $text1 = $oneComment['comment'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){
            $id = $_POST['id'];
            $text = trim($_POST['content']);

            if ($text === '' ) {
                array_push($errMsg, "<p>Комментарий не имеет содержимого текста</p>");
            } elseif (mb_strlen($text, 'UTF8') < 50) {
                array_push($errMsg, "<p>Длина комментария меньше 50-ти символов</p>");
            } else {
                $com = [
                    'comment' => $text,
                ];
                $comment = update('comments', $id, $com);
                header('location: ' . BASE_URL . 'admin/comments/index.php');
            }
        } else {
            // tt($_POST);
            $text = trim($_POST['content']);
        }
?>