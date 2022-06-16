<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link"  href="?page=1">Первая страница</a></li>

        <?php if($page > 1):?>
            <li class="page-item"><a class="page-link"  href="?page=<?php echo ($page - 1);?>">Назад</a></li>
        <?php endif;?>

        
        <?php if($page < $total_pages):?>
            <li class="page-item"><a class="page-link"  href="?page=<?php echo ($page + 1);?>">Вперед</a></li>
        <?php endif;?>

        <li class="page-item"><a class="page-link"  href="?page=<?php echo $total_pages?>">Последняя страница</a></li>
    </ul>
</nav>