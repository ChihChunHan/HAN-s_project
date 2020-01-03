<?php
    $db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');
    date_default_timezone_set('Asia/Taipei');

    $sql='SELECT * FROM 02_works_img WHERE 1';
    $rows=$db->query($sql)->fetchAll();

    $data_json = json_encode($rows);

    echo $data_json;

    // foreach ($rows as $row) {
    //     echo'
    //     <div class="grid-item grid-item-h-4">
    //         <div class="card border-0" style="width: 200px;">
    //         <img src="'.$row['img'].' class="card-img-top shadow" style="border-radius: 5px;object-fit: cover;">
    //         <div class="row"><div class="col-auto cardIcon"><i class="material-icons" >favorite</i></div></div>
    //         <div class="card-body">
    //             <h5 class="card-title m-0" style="font-size: 1rem;">'.$row['title'].'</h5>
    //             <p class="card-text m-0 text-truncate" style="font-size: 0.5rem;">'.$row['content'].'</p>
    //         </div>
    //         </div>
    //     </div>
    //     ';
    // }




?>
