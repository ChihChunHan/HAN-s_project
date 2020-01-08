<?php
    $db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');
    date_default_timezone_set('Asia/Taipei');

    $sql='SELECT * FROM 03_user_info WHERE acc LIKE "%'.$_GET['user'].'%"';

    // $sql='SELECT * FROM 03_user_info WHERE 1';

    $rows=$db->query($sql)->fetchAll();
    $data_json = json_encode($rows);
    echo $data_json;

?>
