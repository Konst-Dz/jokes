<?php
session_start();
$dbHost = 'localhost';
$dbLogin = 'root';
$dbPass = '';
$dbName = 'test';
$connect = mysqli_connect($dbHost,$dbLogin,$dbPass,$dbName);
mysqli_query($connect,"SET NAMES 'utf8'");