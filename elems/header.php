<?php
    if($_SESSION['auth']){
        $id = $_SESSION['id'];

        $query = "SELECT login,name FROM user LEFT JOIN statuses ON user.id_status = statuses.id WHERE  user.id='$id'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        $user = mysqli_fetch_assoc($result);

        echo "Добрый день, {$user['login']} ({$user['name']})<br>";
        echo "<a href=\"../pages/logout.php\">Выйти</a><br>";
        echo "<a href=\"../pages/form.php\">Добавить анекдот</a><br>";


        if($_SESSION['auth'] and $_SESSION['status'] == 2){
            echo "<a href=\"/../admin/index.php\">Admin Page</a><br>";
        }

    }
    else{
        echo  "<a href=\"../pages/login.php\">Login</a>";
        echo  "<a href=\"../pages/registration.php\">Registration</a>";
    }

