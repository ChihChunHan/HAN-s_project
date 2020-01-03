<?php
$db= new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8','root','');
date_default_timezone_set('Asia/Taipei');

$sql='SELECT * FROM 02_works_img WHERE 1';
$rows=$db->query($sql)->fetchAll();

switch ($_GET['nav']) {
    case 'mywork':
        echo '<div class="row mb-4">';  // 卡片群組開頭
        foreach ($rows as $row) {
            // 處裡tag
            $tags = mb_split("\s",$row['tag']);
            //卡片主體
            echo '
            <a class="col-lg-3 col-md-4 col-12 mb-4 text-reset" data-toggle="modal" data-backdrop="false" href="#c'.$row['id'].'">
            <div class="card border-0 shadow">
                <img src="'.$row['img'].'" class=" card-img-top card-img-size" style="object-fit:cover">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 1rem;">'.$row['title'].'</h5>
                    <p>';
            foreach ($tags as $tag) {  // 輸出tag
                echo '<span class="badge badge-secondary mr-1">'.$tag.'</span>';
            }
            echo '
                    </p>
                    <p class="card-text" style="font-size: 0.8rem;">'.$row['content'].'</p>
                    <p class="card-text"><small class="text-muted">'.$row['date'].'</small></p>
                </div>
            </div>';
            // model
            echo '
            </a>

            <div class="modal" id="c'.$row['id'].'" tabindex="-1" style="background-color:rgb(255,255,255,0.7)">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="c'.$row['id'].'Title">修改作品資訊</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-6 col-12">
                            <img src="'.$row['img'].'" class="card-img-top w-100">
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" value="'.$row['title'].'">
                            </div>
                            <div class="form-group">
                                <label>tag</label>
                                <input type="text" class="form-control">
                                <small class="form-text text-muted">';
                                foreach ($tags as $tag) {  // 輸出tag
                                    echo '<span class="badge badge-secondary mr-1">'.$tag.'<a href="#" class="text-reset">&times;</a></span>';
                                };
                                echo'</small>
                            </div>
                            <div class="form-group">
                                <label>text content</label>
                                <textarea class="form-control" rows="3">'.$row['content'].'</textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
            ';
        }
        echo '</div>';
        break;
    case 'mypage':
        echo 'mypage';
        break;
    case 'setting':
        echo 'setting';
        break;
    default:
        # code...
        break;
}




?>