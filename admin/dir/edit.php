<?php

include '../../elems/link.php';
$id = $_GET['edit'];

if(!empty($_POST['joke'])){
    $updJoke = mysqli_real_escape_string($connect,$_POST['joke']);
    $updCat = $_POST['category'];
    $query = "UPDATE joke SET text = '$updJoke', id_category = '$updCat' WHERE id = '$id' ";
    mysqli_query($connect,$query) or die(mysqli_error($connect)) ;

    $_SESSION['message'] = ['text' => 'Изменения сохранены',
        'status' => 'success'];
}

$title = 'Edit page';

$query = "SELECT *,joke.id as joke_id,category.id as cat_id FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 0 AND joke.id = '$id' ";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
$joke = mysqli_fetch_assoc($result);

$text = $joke['text'];
$check = $joke['cat_id'];
//форма
include '../../elems/formJoke.php';

include "../../elems/layout.php";
