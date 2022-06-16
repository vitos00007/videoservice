<?php

    session_start();
    require('connect.php');

    //Отладочная функция с остановкой выполнения
    function tt($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        exit();
    };

    //Отладочная функция без остановки выполнения
    function tte($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    };

    //Проверка выполнения запроса к базе данных
    function dbCheckError($query)
    {
        $errInfo = $query->errorInfo();
        if ($errInfo[0] !== PDO::ERR_NONE) {
            echo $errInfo[2];
            exit();
        }
        return true;
    }

    //Запрос на получение данных одной таблицы
    function selectAll($table, $params = [])
    {
        global $pdo;
        $sql = "SELECT * FROM $table ";

        if (!empty($params)) {
            $i = 0;
            foreach ($params as $key => $value) {
                if (!is_numeric($value)) {
                    $value = "'" . $value . "'";
                }
                if ($i === 0) {
                    $sql = $sql . " WHERE $key = $value";
                } else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //Запрос на получение одной строки с выбранной таблицы
    function selectOne($table, $params = [])
    {
        global $pdo;
        $sql = "SELECT * FROM $table";

        if (!empty($params)) {
            $i = 0;
            foreach ($params as $key => $value) {
                if (!is_numeric($value)) {
                    $value = "'" . $value . "'";
                }
                if ($i === 0) {
                    $sql = $sql . " WHERE $key = $value";
                } else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    //Запись данных в таблицу
    function insert($table, $params)
    {
        global $pdo;
        $i = 0;
        $coll = '';
        $mask = '';
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $coll = $coll . $key;
                $mask = $mask . "'" . $value . "'";
            } else {
                $coll = $coll . ", $key";
                $mask = $mask . ", '" . "$value" . "'";
            }
            $i++;
        }

        $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
        $query = $pdo->prepare($sql);
        $query->execute($params);
        dbCheckError($query);
        return $pdo->lastInsertId();
    }

    //Обновление данных
    function update($table, $id, $params)
    {
        global $pdo;
        $i = 0;
        $str = '';
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $str = $str . $key . " = '" . $value . "'";
            } else {
                $str = $str . ", " . $key . " = '" . "$value" . "'";
            }
            $i++;
        }

        $sql = "UPDATE $table SET $str WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute($params);
        dbCheckError($query);
    }

    //Удаление данных
    function delete($table, $id)
    {
        global $pdo;
        $sql = "DELETE FROM $table WHERE id =" . $id;
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    //Выборка записей с автором в админку (страница posts)
    function selectAllFromPostsWithUsers($table1, $table2)
    {
        global $pdo;
        $sql = "SELECT 
        t1.id,
        t1.title,
        t1.img,
        t1.content,
        t1.status,
        t1.id_topic,
        t1.created_date,
        t2.nickname
        FROM $table1 AS t1 
        JOIN $table2 AS t2 
        ON t1.id_user = t2.id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //Выборка записей с автором на главную
    function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset)
    {
        global $pdo;
        $sql = "SELECT p.*, u.nickname FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //Выборка записи на конктретную страницу
    function selectPostFromPostsWithUserOnSingle($table1, $table2, $id)
    {
        global $pdo;
        $sql = "SELECT p.*, u.nickname FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    //Выборка на страницу категорий
    function selectAllFromPostsWithUsersOnCategory($table1, $table2, $id)
    {
        global $pdo;
        $sql = "SELECT p.*, u.nickname FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id_topic = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //Поиск по заголовкам и содежимому
    function searchInTitleAndContent($text, $table1, $table2)
    {
        $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
        global $pdo;
        $sql = "SELECT 
        p.*, u.nickname
        FROM $table1 AS p 
        JOIN $table2 AS u 
        ON p.id_user = u.id
        WHERE p.status = 1
        AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //Выборка на страницу с видео пользователя
    function selectPostFromPostsIntoMyVideos($table1, $table2, $id, $name)
    {
        global $pdo;
        $sql = "SELECT 
        posts.*, users.nickname
        FROM $table1 AS posts 
        JOIN $table2 AS users 
        ON posts.id_user = $id
        WHERE users.nickname 
        LIKE '$name'";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    //
    function countRow($table){
        global $pdo;
        $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchColumn();
    }

?>