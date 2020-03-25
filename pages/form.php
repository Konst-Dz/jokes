<?php
include "../elems/link.php";

if(isset($_SESSION['auth'])) {
    //Форма для отправления анекдотов от пользователе
   include "../elems/formJoke.php";


//Добавление анекдотов в БД.
    if (!empty($_POST['joke'])) {
        $joke = mysqli_real_escape_string($connect,$_POST['joke']) ;
        $id = $_SESSION['id'];
        $id_category = $_POST['category'];

        $query = "SELECT * FROM joke WHERE text = '$joke'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        $user = mysqli_fetch_assoc($result);

        if (!$user) {

            $query = "INSERT INTO joke SET text = '$joke', id_category = '$id_category' ,
 id_user = '$id' , date = NOW() , status = 0 ";
            mysqli_query($connect, $query) or die(mysqli_error($connect));

            //flash
            $_SESSION['message'] = ['text' => 'Successfully.This joke will be send to admin',
                'status' => 'success'];
        }
    }
}
    else{
    header('Location:login.php');
}
    include "../elems/layout.php";

