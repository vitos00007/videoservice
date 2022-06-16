<?php
    include SITE_ROOT . "/app/controllers/comments.php";
?>

<div class="col-md-12 col-12 comments">
    <h3>Оставить комментарий</h3>
    <form action="<?=BASE_URL . "single.php?post=$page"?>" method="POST">
        <input type="hidden" name="page" value="<?=$page?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш комментарий</label>
        <textarea name="comment" id="exampleFormControlTextarea1" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
    <?php if(count($comments) > 0): ?>
        <div class="row all-comments">
            <h3>Коментарии к видео</h3>
                <?php foreach($comments as $comment): ?>
                    <div class="one-comment col-12">
                        <span><i class="fas fa-envelope-square"></i><?=$comment['email'];?></span>
                        <span><i class="far fa-calendar-alt"></i><?=$comment['created_date'];?></span>
                        <div class="col-12 text">
                            <?=$comment['comment'];?>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>