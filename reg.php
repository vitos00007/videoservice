<?php 
include("path.php"); 
include("app/controllers/users.php");
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

<!-- форма регистрации -->

<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="reg.php">
        <h2>Регистрация</h2>
        <div class="mb-3 col-12 com-md-4 err">
            <?=$errMsg?>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 com-md-4">
            <label for="formGroupExampleInput" class="form-label">Никнейм</label>
            <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите ваш логин">
        </div>
        <div class="w-100"></div>
        <div class="mb-3  col-12 com-md-4">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input name="email" type="email" value="<?=$email?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ваш e-mail адрес не будет использован для спама.</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3  col-12 com-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="first_pass" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3  col-12 com-md-4">
            <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
            <input name="second_pass" type="password" class="form-control" id="exampleInputPassword2">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button name="button-reg" type="submit" class="btn btn-secondary">Регистрация</button>
            <a href="log.php">Авторизоваться</a>
        </div>
            
    </form>
</div>
    
<?php include("app/include/footer.php");?>

    <!-- Дополнительный JavaScript; выберите один из двух! -->

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Вариант 2: Bootstrap JS отдельно от Popper
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>