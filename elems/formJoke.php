<?php
$content = '';
$content .= "<form action=\"\" method=\"POST\">";
//функция выбора категории
include "func/selectCategory.php";
//for admin-edit
$check = $check ?? '';
$text = $text ?? '';

$content .= selectCategory($connect,$check);
$content .= " </select><br><br><p>Ваш анекдот</p>
    <textarea  cols=\"30\" rows=\"10\" name=\"joke\" >$text</textarea><br>
    <input type=\"submit\">
</form> 
";