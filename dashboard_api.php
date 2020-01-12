<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8', 'root', '');
date_default_timezone_set('Asia/Taipei');

$sql = 'SELECT * FROM 02_works_img WHERE 1';
$rows = $db->query($sql)->fetchAll();

switch ($_GET['nav']) {
    case 'mywork':
        echo '<div class="row mb-4">';  // 卡片群組開頭
        foreach ($rows as $row) {
            // 處裡tag
            $tags = mb_split("\s", $row['tag']);
            //卡片主體
            echo '
            <a class="col-lg-3 col-md-4 col-12 mb-4 text-reset" data-toggle="modal" data-backdrop="false" href="#c' . $row['id'] . '">
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
                                <label>tag</label>
                                <input type="text" class="form-control new_tag">
                                <small class="form-text text-muted tagzone">';
            foreach ($tags as $tag) {  // 輸出tag
                echo '<span class="badge badge-secondary mr-1"><span>' . $tag . '</span><a href="#" class="text-reset text-decoration-none" onclick=del_tag(this)>&times;</a></span>';
            };
            echo '</small>
                            </div>
                            <div class="form-group">
                                <label>text content</label>
                                <textarea class="form-control" rows="3">' . $row['content'] . '</textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
                            <button type="submit" class="btn btn-sm btn-danger" onclick=del_work(this)>Delete</button>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
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
        echo 'mypage';
        break;
    case 'setting':
        echo 'setting';
        break;
    case 'upload':
        echo '
        <div class="container-fluid">
            <form action="upload_api.php" method="post">
                <div id="myId" class="dropzone mx-auto mb-5"></div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">title</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">tags</span>
                        </div>
                        <input type="text" id="tagsinput" data-role="tagsinput" value="jQuery,Script,Net">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">content</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <script>
        
            var myDropzone = new Dropzone("#myId", { 
                url: "upload_api.php",
                dictDefaultMessage: "把檔案拉到這裡就可以上傳",
                paramName: "photo"
            });

            $("#tagsinput").tagsinput("refresh");
        </script>

        
        ';
        break;
    default:
        # code...
        break;
}
