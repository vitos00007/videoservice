<?php
include "path.php";
include SITE_ROOT . '/app/controllers/posts.php';
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
  <title>Видеосервис</title>
</head>

<body>
  <?php include("app/include/header.php"); ?>

  <!-- основной блок -->
  <div class="container">
    <div class="content row">

      <div class=" add-post col-12">
        <h2>Загрузка видеоролика</h2>
        <form action="upload_videos.php" method="POST" enctype="multipart/form-data">
          <div class="col err">
            <?php include SITE_ROOT . '/app/controllers/helps/errorinfo.php'; ?>
          </div>
          <div class="col">
            <input value="<?= $title; ?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
          </div>
          <div class="col">
            <label for="content" class="form-label">Содержимое статьи</label>
            <textarea name="content" class="form-control" id="content" rows="6"><?= $content; ?></textarea>
          </div>
          <div class="input-group col">
            <input name="img" type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <select name="topic" class="form-select" aria-label="Default select example">
            <option selected>Категория записи</option>
            <?php foreach ($topics as $key => $topic) : ?>
              <option value="<?= $topic['id'] ?>"><?= $topic['name']; ?></option>
            <?php endforeach; ?>
          </select>
          <div class="col col-6">
            <button name="add_post_user" class="btn btn-primary" type="submit">Добавить запись</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- основной блок -->

  <!-- подвал сайта -->
  <?php include("app/include/footer.php"); ?>
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