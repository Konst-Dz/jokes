<?php
function selectCategory($connect,$check='',$checked='')
{
    $form = '';
    $form .= "<p>Категория</p>
    <select name=\"category\">";
    $query = "SELECT * FROM category";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    foreach ($data as $datum) {
        if($check) {
            //Проверка на selected для admin/edit
            if ($datum['id'] == $check) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
        }

        $form .= "<option value=\"{$datum['id']}\" $checked>{$datum['category']}</option>";
    }
    return $form;
}