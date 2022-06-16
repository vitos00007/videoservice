<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL ?>">Видеосервис</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <?php if ($_SESSION): ?>
                    <li><a href="<?php echo BASE_URL . 'users_videos.php'; ?>">Мои видеоролики</a></li>
                    <li><a href="<?php echo BASE_URL . 'upload_videos.php'; ?>"><i class="far fa-plus-square"></i></a></li>
                    <?php endif; ?>
                    <li>
                        <?php if (isset($_SESSION['id'])) : ?>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <?php echo $_SESSION['nickname']; ?>
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']) : ?>
                                    <li><a href="<?php echo BASE_URL . 'admin/posts/index.php'; ?>">Админпанель</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход</a></li>
                            </ul>
                        <?php else : ?>
                            <a href="<?php echo BASE_URL . 'log.php'; ?>">
                                <i class="fa fa-user"></i>
                                Войти
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'reg.php'; ?>">Регистрация</a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>