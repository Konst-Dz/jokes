<?php
session_start();
error_reporting(E_ALL);
ini_set('display','on');
$dbHost = 'localhost';
$dbLogin = 'root';
$dbPass = '';
$dbName = 'test';
$connect = mysqli_connect($dbHost,$dbLogin,$dbPass,$dbName);
mysqli_query($connect,"SET NAMES 'utf8'");