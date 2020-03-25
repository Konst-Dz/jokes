<?php

include "pagination.php";

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

        $content .= "<p>{$item['text']}</p>";
        $content .= "<span>Категория : {$item['category']}</span><br>";
        $content .= "<span>Прислал : {$item['login']}</span>";
        $content .= "<hr><br>";

    }
    $content .= pagination($howMany,$connect,$page,$category);
    return $content;
}
