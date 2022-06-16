<?php
    include SITE_ROOT . "/app/database/db.php";

    $errMsg = '';
    $id = '';
    $name = '';
    $description = '';
    $topics = selectAll('topics');

    //Создание категории
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){

        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if($name === '' || $description === ''){
            $errMsg = "<p>Не все поля заполнены!</p>";
        }elseif(mb_strlen($name, 'UTF8') < 2){
            $errMsg = "<p>Категория должна быть более 2-х символов</p>";
        }else{
            $existence = selectOne('topics', ['name' => $name]);
            if (!empty($existence['name']) && $existence['name'] === $name) {
                $errMsg = "<p>Такая категория уже существует!</p>";
            } else {
                    $topic = [
                        'name' => $name,
                        'description' => $description
                    ];
                    $id = insert('topics', $topic);
                    $topic = selectOne('topics', ['id' => $id]);
                    header('location: ' . BASE_URL . 'admin/topics/index.php');
            }  
        }
    }else{
        $name = '';
        $description = '';
    }

    //Редактирование категории
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $id = $_GET['id'];
        $topic = selectOne('topics', ['id' => $id]);
        $id = $topic['id'];
        $name = $topic['name'];
        $description = $topic['description'];

    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){

        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if($name === '' || $description === ''){
            $errMsg = "<p>Не все поля заполнены!</p>";
        }elseif(mb_strlen($name, 'UTF8') < 2){
            $errMsg = "<p>Категория должна быть более 2-х символов</p>";
        }else{
                $topic = [
                    'name' => $name,
                    'description' => $description
                ];
                $id = $_POST['id'];
                $topic_id = update('topics', $id, $topic);
                header('location: ' . BASE_URL . 'admin/topics/index.php');
            }
    }

    //Удаление категории
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){
        $id = $_GET['del_id'];  
        delete('topics', $id);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }