<?php
session_start();

$db = new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8', 'root', '');
date_default_timezone_set('Asia/Taipei');



switch ($_GET['nav']) {
    case 'mywork':
        $sql = 'SELECT * FROM 02_works_img WHERE acc ="'.$_SESSION['user'].'"';
        $rows = $db->query($sql)->fetchAll();
        echo '<div class="row mb-4">';  // 卡片群組開頭
        foreach ($rows as $row) {
            // 處裡tag
            $tags = mb_split(",", $row['tag']);
            //卡片主體
            echo '
            <a class="col-lg-3 col-md-4 col-12 mb-4 text-reset" data-toggle="modal" data-backdrop="ture" href="#c' . $row['id'] . '">
            <div class="card border-0 shadow">
                <img src="' . $row['img'] . '" class=" card-img-top card-img-size" style="object-fit:cover">
                <div class="card-body">
                    <h5 class="card-title text-truncate" style="font-size: 1rem;">' . $row['title'] . '</h5>
                    <p class="text-truncate">';
            foreach ($tags as $tag) {  // 輸出tag
                echo '<span class="badge badge-secondary mr-1">' . $tag . '</span>';
            }
            echo '
                    </p>
                    <p class="card-text text-truncate" style="font-size: 0.8rem;">' . $row['content'] . '</p>
                    <p class="card-text"><small class="text-muted">' . $row['date'] . '</small></p>
                </div>
            </div>';
            // model
            echo '
            </a>

            <div class="modal fade" id="c' . $row['id'] . '" tabindex="-1" style="background-color:rgb(255,255,255,0.7)">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="c' . $row['id'] . 'Title">修改作品資訊</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-6 col-12">
                            <img src="' . $row['img'] . '" class="card-img-top w-100">
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>title</label>
                                <input type="text" class="form-control" value="' . $row['title'] . '">
                            </div>
                            <div class="form-group">
                                <label>tag</label><br>
                                <input type="text" name="tag" class="tagsinput" data-role="tagsinput" value="'. $row['tag'] .'">
                            </div>
                            <div class="form-group">
                                <label>text content</label>
                                <textarea class="form-control" rows="3">' . $row['content'] . '</textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary card_submit">Submit</button>
                            <button type="submit" class="btn btn-sm btn-danger" onclick=del_work(this)>Delete</button>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <script>
            $("input[data-role=tagsinput]").tagsinput()
            </script>
            ';
        }
        echo '</div>';
        break;
    case 'mywork_update':
        $id = substr($_POST['id'], 1, strlen($_POST['id']));
        $sql = 'UPDATE 02_works_img SET title="' . $_POST['title'] . '", tag="' . $_POST['tags'] . '", content="' . $_POST['content'] . '", date=NOW() WHERE id="' . $id . '"';
        $result = $db->query($sql);

        if ($result) echo date('Y-m-d H:i:s');
        break;
    case 'mywork_delete':
        $id = substr($_POST['id'], 1, strlen($_POST['id']));
        $sql = 'DELETE FROM 02_works_img WHERE id=' . $id;
        $result = $db->query($sql);
        if ($result) echo 'deleted';
        break;
    case 'mypage':
        $sql = 'SELECT * FROM 03_user_info WHERE acc LIKE"'.$_SESSION['user'].'"';
        $rows = $db->query($sql)->fetchAll();
        // echo $sql;
        // print_r($rows);
        echo '
            <div class="text-center h5">'.$rows[0]['acc'].'</div>
            <form action="dashboard_api.php?nav=mypage_update" method="post" enctype="multipart/form-data">
                <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="'.$rows[0]['user_img'].'" class="rounded-circle bg-info mb-3" style="object-fit:cover;width: 150px;height:150px" >
                    <small id="passwordHelpBlock" class="form-text text-muted">
                    修改你的大頭貼
                    </small>
                    <input id="input-b2" name="input-b2" type="file" class="file" data-show-preview="false">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text">用戶名稱</span>
                    </div>
                    <input id="name" type="text" class="form-control" name="name" placeholder="請輸入名稱" value="'.$rows[0]['name'].'">
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">介紹文字</span>
                    </div>
                    <textarea id="info" name="info" class="form-control">'.$rows[0]['info'].'</textarea>
                </div>

                <button type="submit" class="btn my-3 border border-dark btn-light">修改</button>
                <button type="reset" class="btn my-3 border border-dark btn-light">重置</button>

            </for>
            <script>
            $(document).ready(function() {
                $("#input-b2").fileinput({
                    language: "zh-TW",
                    showPreview: false,
                    showUpload: false,
                    elErrorContainer: "#kartik-file-errors",
                    allowedFileExtensions: ["jpg", "png", "gif"],
                    uploadUrl: "user_upload_api"
                });
            });
            </script>
        ';
        break;
    case 'mypage_update':
        if(!empty($_FILES['input-b2']['name'])){
            $images = $_FILES['input-b2']; // 獲取上傳的文件
            $filenames = $images['name']; // 文件名
            $filetypes = $images['type']; // 文件類型
            $filesizes = $images['size']; // 文件大小
            $filetmps = $images['tmp_name']; // 文件臨時路徑

            $url='images/user_img_upload/'.$_SESSION['user'].'_'.time().'_'.$filenames;
            // upload file
            copy($_FILES['input-b2']['tmp_name'],$url);
            // delete file
            unlink($_FILES['input-b2']['tmp_name']);

            $sql = 'UPDATE 03_user_info SET name="'. $_POST['name'] . '", info="' . $_POST['info'] . '", user_img="' . $url . '" WHERE acc="'.$_SESSION['user'].'"';
        }
        else{
            $sql = 'UPDATE 03_user_info SET name="'. $_POST['name'] . '", info="' . $_POST['info'] . '" WHERE acc="'.$_SESSION['user'].'"';
        }
        $result = $db->query($sql);
        header('location:dashboard.php');
        break;
    case 'new_work':
        echo '
            <form class="form form-vertical" action="dashboard_api.php?nav=upload" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4 col-12 text-center">
                        <div class="kv-avatar ">
                            <div class="file-loading">
                                <input id="avatar-1" name="avatar-1" type="file" required>
                            </div>
                        </div>
                        <div class="kv-avatar-hint">
                            <small>檔案大小 < 5mb</small>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row">
                            <div class="col-12">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">作品標題</span>
                                    </div>
                                    <input type="text" name="title" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">作品標籤</span>
                                </div>
                                    <div class="tagsinput-box">
                                        <input type="text" name="tag" id="tagsinput" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">作品說明</span>
                                </div>
                                <textarea class="form-control" name="content"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="width" id="width">
                        <input type="hidden" name="height" id="height">
                    </div>
                </div>
            </form>
            <div id="kv-avatar-errors-1" class="center-block" style="width:100%;display:none"></div>
            <script>
            
            // bs File input

            $("#avatar-1").fileinput({
                language: "zh-TW",
                overwriteInitial: true,
                maxFileSize: 5000,
                showClose: false,
                showCaption: false,
                browseLabel: "",
                removeLabel: "",
                autoOrientImage:false,

                removeTitle: "Cancel or reset changes",
                elErrorContainer: "#kv-avatar-errors-1",
                msgErrorClass: "alert alert-block alert-danger",
                allowedFileExtensions: ["jpg", "png", "gif"]
            });
            $("#avatar-1").on("fileimagesloaded", function(event, file, previewId, index, reader) {
                let width = $(".file-preview-image")[1].width
                let height = $(".file-preview-image")[1].height
                $("#width").val(width)
                $("#height").val(height)
            });

            $("input[data-role=tagsinput]").tagsinput()
            </script>
        ';
        break;
    case 'upload':
        $images = $_FILES['avatar-1']; // 獲取上傳的文件
        $filenames = $images['name']; // 文件名
        $filetypes = $images['type']; // 文件類型
        $filesizes = $images['size']; // 文件大小
        $filetmps = $images['tmp_name']; // 文件臨時路徑
        $url='images/works_upload/'.$_SESSION['user'].'_'.time().'_'.$_POST['title'];
        // upload file
        copy($filetmps,$url);
        // delete file
        unlink($filetmps);
        
        $sql = 'INSERT INTO 02_works_img (img, width, height, acc, title, tag, content, date) VALUES ("'.$url.'","'.$_POST['width'].'","'.$_POST['height'].'","'.$_SESSION['user'].'","'.$_POST['title'].'","'.$_POST['tag'].'","'.$_POST['content'].'",NOW())';
        $result = $db->query($sql);
        header('location:dashboard.php');
        break;
    default:
        # code...
        break;
}
