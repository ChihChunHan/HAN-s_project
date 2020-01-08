<?php
    $db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');
    date_default_timezone_set('Asia/Taipei');

    if(!empty($_GET['search'])){
        $sql='SELECT * FROM 02_works_img WHERE tag LIKE "%'.$_GET['search'].'%"';
        $rows=$db->query($sql)->fetchAll();
        $data_json = json_encode($rows);
        echo $data_json;
    }

    else {
        $sql='SELECT * FROM 02_works_img WHERE 1';
        $rows=$db->query($sql)->fetchAll();
        $data_json = json_encode($rows);
        echo $data_json;
    }

    // switch ($_GET['do']) {
    //     case 'init':
    //         $sql='SELECT * FROM 02_works_img WHERE 1';
    //         $rows=$db->query($sql)->fetchAll();
        
    //         $data_json = json_encode($rows);
        
    //         echo $data_json;
    //     break;
        // case 'search':
        //     $sql='SELECT * FROM 02_works_img WHERE tag LIKE "%'.$_POST['key'].'%"';
        //     $rows=$db->query($sql)->fetchAll();
        
        //     $data_json = json_encode($rows);
        
        //     echo $data_json;
        // break;
    //     default:
    //         # code...
    //         break;
    // }


?>
