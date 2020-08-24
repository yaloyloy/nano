<?php
    // include('admin/action/action.php');
    // $db=new Action;

    $host = 'localhost';
    $db = 'nano_web';
    $user = 'root';
    $pass = '';

    $cnx = new PDO('mysql:host='.$host.'; dbname='.$db.'; user='.$user.'; pass='.$pass.'');


?>