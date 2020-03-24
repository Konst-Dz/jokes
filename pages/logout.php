<?php
session_start();
$_SESSION['auth'] = null;
$_SESSION['message'] = ['text' => 'Вы успешно вышли',
    'status' => 'success'];
header('Location:../index.php');