<?php
    include SITE_ROOT . "/app/database/db.php";
    if (!$_SESSION) {
        header('location: ' . BASE_URL . 'log.php');
    }

    $errMsg = [];
    $id = '';
    $title = '';
    $content = '';
    $img = '';
    $topic = '';

    $topics = selectAll('topics');
    $posts = selectAll('posts');
    $postsAdm = selectAllFromPostsWithUsers('posts', 'users');

    //Создание записи
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

        if (!empty($_FILES['img']['name'])) {
            $imgName = time() . "_" . $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileType = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\sources\uploaded\\" . $imgName;

            if (strpos($fileType, 'video') === false) {
                array_push($errMsg, "<p>Можно загружать только видео</p>");
            } else {
                $result = move_uploaded_file($fileTmpName, $destination);

                if ($result) {
                    $_POST['img'] = $imgName;
                } else {
                    array_push($errMsg, "<p>Ошибка загрузки на сервер</p>");
                }
            }
        } else {
            array_push($errMsg, "<p>Ошибка получения файла</p>");
        }

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;

        if ($title === '' || $topic === '') {
            array_push($errMsg, "<p>Не все поля заполнены!</p>");
        } elseif (mb_strlen($title, 'UTF8') < 5) {
            array_push($errMsg, "<p>Название статьи должно быть более 5-ми символов</p>");
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'img' => $_POST['img'],
                'content' => $content,
                'status' => $publish,
                'id_topic' => $topic
            ];
            $post = insert('posts', $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    } else {
        $id = '';
        $title = '';
        $content = '';
        $publish = '';
        $topic = '';
    }

    //Создание записи cо страницы загрузки для пользователей
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post_user'])) {

        if (!empty($_FILES['img']['name'])) {
            $imgName = time() . "_" . $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileType = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\sources\uploaded\\" . $imgName;

            if (strpos($fileType, 'video') === false) {
                array_push($errMsg, "<p>Можно загружать только видео</p>");
            } else {
                $result = move_uploaded_file($fileTmpName, $destination);

                if ($result) {
                    $_POST['img'] = $imgName;
                } else {
                    array_push($errMsg, "<p>Ошибка загрузки на сервер</p>");
                }
            }
        } else {
            array_push($errMsg, "<p>Ошибка получения файла</p>");
        }

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;

        if ($title === '' || $topic === '') {
            array_push($errMsg, "<p>Не все поля заполнены!</p>");
        } elseif (mb_strlen($title, 'UTF8') < 5) {
            array_push($errMsg, "<p>Название статьи должно быть более 5-ми символов</p>");
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'img' => $_POST['img'],
                'content' => $content,
                'status' => $publish,
                'id_topic' => $topic
            ];
            $post = insert('posts', $post);
            header('location: ' . BASE_URL . 'upload_videos.php');
        }
    } else {
        $id = '';
        $title = '';
        $content = '';
        $publish = '';
        $topic = '';
    }

//Редактирование записи
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $img = $post['img'];
    $content = $post['content'];
    $publish = $post['status'];
    $topic = $post['id_topic'];

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;

        if ($title === '' || $content === '' || $topic === '') {
            array_push($errMsg, "<p>Не все поля заполнены!</p>");
        } elseif (mb_strlen($title, 'UTF8') < 7) {
            array_push($errMsg, "<p>Название статьи должно быть более 7-ми символов</p>");
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'img' => $_POST['img'],
                'content' => $content,
                'status' => $publish,
                'id_topic' => $topic
            ];
            $post = update('posts', $id, $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    } else {
        $title = '';
        $content = '';
        $publish = isset($_POST['publish']) ? 1 : 0;
        $topic = '';
    }

//Publish, unpublish
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];  
    $publish = $_GET['publish'];
    $postId = update('posts', $id, ['status' => $publish]);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}

//Удаление записи
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];  
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}