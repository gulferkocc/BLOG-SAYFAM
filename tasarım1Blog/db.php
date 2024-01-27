<?php
try {
    $conn = mysqli_connect('localhost','root','','blog') or die('connection failed');

    $DBConnection = new PDO("mysql:host=localhost;dbname=blog;charset=utf8;",'root','');

    //echo 'DB Conn 200';
}catch(PDOException $e){
    echo $e->getMessage();
}









   