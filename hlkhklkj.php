<?php

include 'elems/link.php';


$list = '';
$list .= "<form action=\"\" method=\"GET\">
  <select name=\"list\">";

$query = "SELECT * FROM category";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
for($data = [];$row = mysqli_fetch_assoc($result);$data[] = $row);

$list.= "<option value=\"\">Все</option>";
foreach ($data as $datum) {

    $list.= "<option value=\"{$datum['id']}\">{$datum['category']}</option> ";

}

$list .= "</select><input type=\"submit\" value=\"Выбрать\"><br></form>";




if(isset($_GET['page']) and is_numeric($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}

if($_GET['list']){

}

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


}

function content($connect,$category){
    $notes = 2;
    $from = ($page-1) * $notes;

    $query = "SELECT * FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 1 and category = '$category' ORDER BY date LIMIT $from,$notes";
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
    for($data = [];$row = mysqli_fetch_assoc($result);$data[]=$row );

    $content='';
    foreach ( $data as $item) {

        $content .= "<p>{$item['text']}</p>";
        $content .= "<span>Категория : {$item['category']}</span><br>";
        $content .= "<span>Прислал : {$item['login']}</span>";
        $content .= "<hr><br>";

    }
    return $content;
}



include 'elems/layout.php';



?>

<form action="" method="get"></form>
