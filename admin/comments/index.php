<?php
  include "../../path.php";
  include "../../app/controllers/comments.php";
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
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Видеосервис</title>
  </head>

  <body>
    <?php include("../../app/include/header-admin.php"); ?>

    <div class="container">
      <?php include("../../app/include/sidebar-admin.php"); ?>
      <div class="posts col-9">
        <div class="row title-table">
          <h2>Управление комментариями</h2>
          <div class="id col-1">ID</div>
          <div class="title col-5">Текст</div>
          <div class="author col-3">Автор</div>
          <div class="red col-3">Управление</div>
        </div>
        <?php foreach ($commentsForAdm as $key => $comment) : ?>
          <div class="row post">
            <div class="id col-1"><?= $comment['id']; ?></div>
            <div class="title col-5"><?=mb_substr($comment['comment'],0,50,'UTF-8'); ?></div>
              <?php 
                $user = $comment['email'];
                $user = explode('@', $user);
                $user = $user[0];
              ?>
            <div class="author col-3"><?= $user . '@'?></div>
            <div class="red col-1"><a href="edit.php?id=<?=$comment['id'];?>">edit</a></div>
            <div class="del col-1"><a href="edit.php?delete_id=<?=$comment['id'];?>">delete</a></div>
            <?php if ($comment['status']) : ?>
              <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['id'];?>">unpublish</a></div>
            <?php else : ?>
              <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['id'];?>">publish</a></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    </div>

    <!-- подвал сайта -->
    <?php include("../../app/include/footer.php"); ?>
    <!-- подвал сайта -->



    <!-- Дополнительный JavaScript; выберите один из двух! -->

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Вариант 2: Bootstrap JS отдельно от Popper
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      -->
  </body>

</html>