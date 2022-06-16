<?php
include 'path.php';
include "app/controllers/topics.php";
$post = selectPostFromPostsWithUserOnSingle('posts', 'users', $_GET['post']);

?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/49fad45336.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="assets/scripts/script.js" type="text/javascript"></script>
    <title>Видеосервис</title>
</head>

<body>
    <?php include("app/include/header.php"); ?>

    <!-- основной блок -->
    <div class="container">
        <div class="content row">

                <div class="main-content col-md-9 col-12">
                    <h2><?=$post['title']; ?></h2>
                    <div class="single_post row">
                        <div class="vid col-12">
                            <video class="col-12 col-md-12" autoplay controls>
                                <source src="<?= BASE_URL . 'assets/sources/uploaded/' . $post['img'] ?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="info col-12">
                            <i class="far fa-user"><?= $post['nickname']; ?></i>
                            <i class="far fa-calendar"><?= $post['created_date']; ?></i>
                        </div>
                        <div class="single_post_text col-12">
                            <p><?= $post['content']; ?></p>
                        </div>
                        <!--Подключение комментариев-->
                    </div>
                </div>
 


            <div class="sidebar col-md-3 col-12">
                <div class="section search">
                    <h3>Поиск</h3>
                    <form action="index.html" method="post">
                        <input type="text"name="search-term" class="text-input" placeholder="Search...">
                    </form>
                </div>

                <div class="section topics">
                    <h3>Категории</h3>
                    <ul>
                        <?php foreach ($topics as $key => $topic) : ?>
                            <li><a href="<?= BASE_URL . 'category.php?id=' . $topic['id']; ?>"><?= $topic['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- основной блок -->

    <?php include("app/include/footer.php"); ?>

    <!-- Дополнительный JavaScript; выберите один из двух! -->

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Вариант 2: Bootstrap JS отдельно от Popper
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>