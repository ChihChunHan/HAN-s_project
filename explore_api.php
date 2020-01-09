<?php
    $db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');
    date_default_timezone_set('Asia/Taipei');

    if(!empty($_GET['search'])){
        $sql='SELECT * FROM 02_works_img AS t1, 03_user_info AS t2 WHERE t1.acc = t2.acc AND tag LIKE "%'.$_GET['search'].'%"';
        $rows=$db->query($sql)->fetchAll();
        $data_json = json_encode($rows);
        echo $data_json;
    }

    else {
        $sql='SELECT * FROM 02_works_img AS t1, 03_user_info AS t2 WHERE t1.acc = t2.acc';
        $rows=$db->query($sql)->fetchAll();
        $data_json = json_encode($rows);
        echo $data_json;
    }

?>
