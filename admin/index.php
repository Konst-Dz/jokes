<?php

include '../elems/link.php';

if($_SESSION['auth'] and $_SESSION['status'] == 2) {
    $title = 'admin panel';
//Удаление
    if (isset($_GET['delete'])) {

        $delete = $_GET['delete'];
        $query = "DELETE FROM joke WHERE id = '$delete'";
        mysqli_query($connect, $query) or die(mysqli_error($connect));

        $_SESSION['message'] = ['text' => 'The joke has been deleted',
            'status' => 'success'];
    }

//Добавление анекдота на сайт
    if (isset($_GET['add'])) {

        $add = $_GET['add'];
        $query = "UPDATE joke SET status = 1 WHERE id = '$add' ";
        mysqli_query($connect, $query) or die(mysqli_error($connect));

        $_SESSION['message'] = ['text' => 'The joke added at the site',
            'status' => 'success'];
    }

//Выборка всех новых анекдотов в таблицу.
    $query = "SELECT *,joke.id as joke_id,category.id as cat_id FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 0";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    if ($data) {

        $content = '';
        $content = "<table><tr><th>Анекдот</th><th>Категория</th><th>Прислал</th>
<th>Принять</th><th>Редактировать</th><th>Удалить</th></tr>";

        foreach ($data as $item) {

            $content .= "<tr><td>{$item['text']}</td><td>{$item['category']}</td><td>{$item['login']}</td>
<td><a href=\"?add={$item['joke_id']}\">Принять</a>
<td><a href=\"dir/edit.php?edit={$item['joke_id']}&catId={$item['cat_id']}\">Редактировать</a></td>
<td><a href=\"?delete={$item['joke_id']}\">Удалить</a></td></tr>";

        }
        $content .= "</table>";

    } else {
        $content = "Нет новых анекдотов";
    }
}
else {
    header('Location:../pages/login.php');
}

include "../elems/layout.php";

