<?php
include '../elems/link.php';

if($_GET['delete']){

    $delete = $_GET['delete'];
    $query = "DELETE FROM joke WHERE id = '$delete'";
    mysqli_query($connect,$query) or die(mysqli_error($connect)) ;

}

if($_GET['add']){

    $add = $_GET['add'];
    $query = "UPDATE joke SET status = 1 WHERE id = '$add' ";
    mysqli_query($connect,$query) or die(mysqli_error($connect)) ;

}

$query = "SELECT *,joke.id as joke_id FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 0";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
for($data = [];$row = mysqli_fetch_assoc($result);$data[]=$row );

if($data) {

    $content = '';
    $content = "<table><tr><td>Анекдот</td><td>Категория</td><td>Прислал</td>
<td>Принять</td><td>Редактировать</td><td>Удалить</td></tr>";

    foreach ($data as $item) {

        $content .= "<tr><td>{$item['text']}</td><td>{$item['category']}</td><td>{$item['login']}</td>
<td><a href=\"?add={$item['joke_id']}\">Принять</a>
<td><a href=\"?edit={$item['joke_id']}\">Редактировать</a></td>
<td><a href=\"?delete={$item['joke_id']}\">Удалить</a></td></tr>";

    }
    $content .= "</table>";
    echo "$content";
}
else{
    echo "Нет новых анекдотов";
}



var_dump($_GET);
