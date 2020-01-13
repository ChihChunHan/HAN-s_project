<?php
    $db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');

    if(!empty($_GET['id'])){
        $sql='SELECT * FROM 02_works_img AS t1, 03_user_info AS t2 WHERE t1.acc = t2.acc AND t2.acc LIKE'.$_GET['id'];
        $rows_api=$db->query($sql)->fetchAll();
        if(empty($rows_api)){
            $data_json = json_encode($rows_api);
            echo $data_json;        
        }
        else{
            $data_json = json_encode($rows_api);
            echo $data_json;
        }
    }
?>
