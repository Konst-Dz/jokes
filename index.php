<?php
//Коннект к БД.
include 'elems/link.php';

//список категорий.
$list = '';
$query = "SELECT * FROM category";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
for($data = [];$row = mysqli_fetch_assoc($result);$data[] = $row);

$list .= "<ul class=\"list\"><li><a href=\"/\">Все анекдоты</a></li>";

foreach ($data as $datum) {
    $list .= "<li><a href=\"?list={$datum['id']}\">{$datum['category']}</a></li>";
   }

$list .= "</ul>";


//Форма для отправления анекдотов от пользователей
$form = '';
$form .= "<form action=\"\" method=\"POST\">
    <p>Ваш логин <br><input type=\"text\" name=\"login\"> </p>
    <p>Категория</p>
    <select name=\"category\">";

$query = "SELECT * FROM category";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
for($data = [];$row = mysqli_fetch_assoc($result);$data[] = $row);

foreach ($data as $datum) {
   $form .= "<option value=\"{$datum['id']}\">{$datum['category']}</option>";
   }

   $form .= " </select><br><br><p>Ваш анекдот</p>
    <textarea  cols=\"30\" rows=\"10\" name=\"joke\"></textarea><br>
    <input type=\"submit\">
</form> 
";

//Добавление анекдотов в БД.
if(!empty($_POST['login']) and !empty($_POST['joke'])) {
    $joke = $_POST['joke'];
    $login =$_POST['login'];
    $id_category = $_POST['category'];

    $query = "SELECT * FROM user WHERE login = '$login'";
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
    $user = mysqli_fetch_assoc($result);

         if(!$user){

             $query = "INSERT INTO user SET login = '$login' ";
             mysqli_query($connect,$query) or die(mysqli_error($connect));

             $query = "SELECT id FROM user WHERE login = '$login'";
             $result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
             $user = mysqli_fetch_assoc($result);
           }
    $id_user = $user['id'];

    $query = "INSERT INTO joke SET text = '$joke', id_category = '$id_category' ,
 id_user = '$id_user' , date = NOW() , status = 0 ";
    mysqli_query($connect,$query) or die(mysqli_error($connect)) ;

    //flash
    $_SESSION['message'] = ['text' => 'Successfully.This joke will be send to admin',
        'status' => 'success'];
}


//Пагинация
if(isset($_GET['page']) and is_numeric($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
//Кол-во записей на странице
$howMany = 2;
//Вывод ссылок на страницу
function pagination($howMany,$connect){
//Получение кол-ва анекдотов из БД
    $query = "SELECT COUNT(*) as count FROM joke WHERE status = 1 ";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $rows = mysqli_fetch_assoc($result)['count'];
//вычисление колв страниц
    $pages = ceil($rows / $howMany);

    echo "<div class=\"pages\">";
    echo "<a class=\"$disabled\"></a>"
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href=\"?page=$i\">$i</a>";
    }
    echo "</div>";
}

//Функция.Вывод анекдотов на страницу с пагинацией.
$category = $_GET['list'];
function content($connect,$page,$category = '',$howMany){
    $from = ($page-1) * $howMany;

    if($category) {
        $query = "SELECT * FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 1 AND category.id = '$category' ORDER BY date LIMIT $from,$howMany";
    }
    else{
        $query = "SELECT * FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 1 ORDER BY date LIMIT $from,$howMany";
    }
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
    for($data = [];$row = mysqli_fetch_assoc($result);$data[]=$row );

    $content='';
    foreach ( $data as $item) {

        echo "<p>{$item['text']}</p>";
        echo "<span>Категория : {$item['category']}</span><br>";
        echo "<span>Прислал : {$item['login']}</span>";
        echo "<hr><br>";

    }
    pagination($howMany,$connect);
}
//Флеш сообщение
include 'elems/info.php';
include 'elems/layout.php';

