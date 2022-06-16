<?php
  include "path.php";
  include "app/controllers/topics.php";
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = 2;
  $offset = $limit * ($page - 1);
  $total_pages = round(countRow('posts') / $limit, 0);
  $posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
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
    <?php include("app/include/header.php");?>
    <!-- каруселька -->
    <div class="container">
        <div class="row">
            <h2 class="slider-title">Топ видео</h2>
        </div>
    </div>
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <?php foreach($posts as $key => $post):?>
              <?php if($key == 0):?>
              <div class="carousel-item active">  
                <?php else: ?>
                <div class="carousel-item">
                <?php endif; ?> 
                <video  class="d-block w-100">
                    <source src= "<?= BASE_URL . 'assets/sources/uploaded/' . $post['img'] ?>" type="video/mp4">
                  </video>
                <div class="carousel-caption d-none d-md-block">
                  <a href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><h5><?=substr($post['title'], 0, 100) . '...'?></h5></a>
                  <p><?=substr($post['content'], 0, 100) . '...'?></p>
                </div>
              </div>
            <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Предыдущий</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Следующий</span>
            </button>
          </div>
    </div>
    <!-- каруселька -->
    
    <!-- основной блок -->
    <div class="container">
        <div class="content row">
            
            <div class="main-content col-md-9 col-12">
                <h2>Последние видео</h2>
                <?php foreach($posts as $post) :?>
                <div class="post row">
                    <div class="vid col-10 col-md-4">
                        <video  class="img-thumbnail">
                            <source src="<?= BASE_URL . 'assets/sources/uploaded/' . $post['img'] ?>" type="video/mp4">
                          </video>
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><?=substr($post['title'], 0, 120) . '...'?></a>
                        </h3>
                        <i class="far fa-user"> <?=$post['nickname']?></i>
                        <i class="far fa-calendar"> <?=$post['created_date']?></i>
                        <p class="preview-text"><?=substr($post['content'], 0, 170) . '...'?></p>
                    </div>
                </div>
                  <?php endforeach; ?>
                  <?php include("app/include/pagination.php");?> 
            </div>
               
            <div class="sidebar col-md-3 col-12">
                <div class="section search">
                    <h3>Поиск</h3>
                    <form action="search.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Search...">
                    </form>
                </div>

                <div class="section topics">
                    <h3>Категории</h3>
                    <ul>
                        <?php foreach ($topics as $key => $topic): ?>
                          <li><a href="<?=BASE_URL . 'category.php?id=' . $topic['id'];?>"><?=$topic['name'];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- основной блок -->

    <!-- подвал сайта -->
    <?php include("app/include/footer.php");?>
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