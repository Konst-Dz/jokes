<?php

include '../../elems/link.php';

$id = $_GET['edit'];

$query = "SELECT *,joke.id as joke_id FROM joke LEFT JOIN category ON joke.id_category = category.id LEFT JOIN 
user ON joke.id_user = user.id WHERE status = 0 AND joke.id = '$id' ";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
$joke = mysqli_fetch_assoc($result);

$content = '';
$content .= "<form action=\"\" method=\"POST\"> ";
$content .= "<textarea name=\"text\" id=\"\" cols=\"30\" rows=\"10\">{$joke['text']}</textarea>Текст<br>";
$content .= "<input type=\"text\" name=\"login\" value=\"{$joke['login']}\" disabled>Логин<br>";
$content .= "";

$query = "SELECT * FROM category";
$result = mysqli_query($connect,$query) or die(mysqli_error($connect)) ;
for($data = [];$row = mysqli_fetch_assoc($result);$data[] = $row);

$content .= "<select name=\"category\">";
foreach ($data as $datum) {
    $content .= "<option value=\"{$datum['id']}\">{$datum['category']}</option>";
}

$content .= "</select><br>";
$content .= "<input type=\"submit\">";
$content .= "</form>";

echo $content;
?>
