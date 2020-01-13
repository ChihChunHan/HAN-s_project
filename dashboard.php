<?php
  session_start();

  if(empty($_SESSION['user'])){
      header("Location: explore.php"); 
      exit;
  }

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./css/bootstrap.css">
  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:100,300,400,500,700,900&display=swap&subset=chinese-traditional" rel="stylesheet">
  <!-- tags input -->
  <link rel="stylesheet" href="./css/tagsinput.css">
  <!-- UPPY -->
  <link href="https://transloadit.edgly.net/releases/uppy/v1.7.0/uppy.min.css" rel="stylesheet">
  <!-- font-awesome -->
  <link rel="stylesheet" href="./css/all.min.css">
  <!-- bs file input -->
  <link rel="stylesheet" href="kartik-v-bootstrap/css/fileinput.css">
  <link rel="stylesheet" href="kartik-v-bootstrap/themes/explorer-fa/theme.css">


  <link rel="stylesheet" href="./css/style.css">
  <title>Hello, world!</title>
  
  <style>
    * {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .dropzone{
      border: 1px solid #000;
      width: 200px;
      height: 200px;
    }
  </style>
</head>

<body>
  <!-- nav-bar -->
  <div class="container-fluid fixed-top ">
    <!-- top-nav-bar -->
    <div class="row">
      <div class="container bg-white">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="explore.php">Gathere</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="explore.php">探索</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link" href="#">新增作品</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link" href="#">作品管理</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link" href="#">我的主頁</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link" href="#">設定</a>
              </li>
            </ul>
                <form action="explore.php" method="get" class="form-inline my-2 my-lg-0 w-75">
                  <input class="form-control form-control-sm mr-sm-2 w-75 ml-auto" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-sm btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
          </div>
        </nav>
      </div>
    </div>
    <div class="line"></div>
    <!-- side-nav-bar -->
    <!-- <div class="container d-lg-block d-none" style="margin-top: calc(5rem - 56px);">
      <div class="row">
        <div class="col-2 vh-100 border-right">
          <div class="row flex-column">
            <a href="#" class="col py-2 text-reset mywork">作品</a>
            <a href="#" class="col py-2 text-reset mypage">我的主頁</a>
            <a href="#" class="col py-2 text-reset setting">設定</a>
          </div>
        </div>
      </div>
    </div> -->
  </div>
  <!-- content -->
  <div class="container" style="margin-top: 5rem;">
    <div class="row">
      <div class="col-2 d-lg-block d-none">
        <div class="row flex-column">
          <a href="#" class="col py-2 text-reset mywork">作品管理</a>
          <a href="#" class="col py-2 text-reset mypage">我的主頁</a>
          <a href="#" class="col py-2 text-reset setting">設定</a>
          <a href="#" class="col py-2 text-reset upload ">新增作品</a>
        </div>
      </div>
      <div class="col-lg-10 col-12 h-100" id="main">
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./js/jquery-3.4.1.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <!-- tags input -->
  <script src="./js/tagsinput.js"></script>  

  <script src="./js/dropzone.js"></script>

  <!-- bs4 file input| -->
  <script src="kartik-v-bootstrap/js/plugins/sortable.js" type="text/javascript"></script>
  <script src="kartik-v-bootstrap/js/fileinput.js" type="text/javascript"></script>
  <script src="kartik-v-bootstrap/js/locales/zh-TW.js" type="text/javascript"></script>
  <script src="kartik-v-bootstrap/themes/explorer-fas/theme.js" type="text/javascript" ></script>
  <script src="kartik-v-bootstrap/themes/fas/theme.js" type="text/javascript" ></script>
  <script>
    var getUrlString = location.href;
    var url = new URL(getUrlString);


    // init
    $(document).ready(()=>{
      showData('mywork')
      // adjustImg()
    })

    // ajax
    function showData(nav){
      $.post('dashboard_api.php?nav='+nav,function(e){
          $('#main').html(e)
          $('#card_submit').click(update)
          adjustImg()
          $('.new_tag').on('keyup',addtag)
        })
    }

    function swichNav(nav){
      $.post('dashboard_api.php?nav='+nav,function(e){
          $('#main').html(e)
        })
    }

    $('.mywork').on('click',(e)=>{
      e.preventDefault();
      showData('mywork');
    })

    $('.mypage').on('click',(e)=>{
      e.preventDefault();
      swichNav('mypage');
    })

    $('.setting').on('click',(e)=>{
      e.preventDefault();
      swichNav('setting');
    })

    $('.upload').on('click',(e)=>{
      e.preventDefault();
      swichNav('upload');
    })

    // ajax更新資料
    function update(e) {
      // e.preventDefault()
      let who = $(this).parents(".modal")
      let newdata = {
        id:who.attr('id'),
        title:who.find('input').eq(0).val(),
        // tag:who.find('span').eq(0),
        tags:"",
        content:who.find('textarea').eq(0).val()
      }

      // 處裡tags
      let tag_html=''
      for (let i = 0; i < who.find('span>span').length; i++) {
        let tag = who.find('span>span').eq(i).text()
        if(i==0) newdata.tags+=tag
        else newdata.tags+= " "+tag
        tag_html+=`<span class="badge badge-secondary mr-1">${tag}</span>`
      }
      // 動態更新前端
      who.prev().find('.card-title').text(newdata.title)
      who.prev().find('.badge').parent().html(tag_html)
      who.prev().find('.card-text').eq(0).text(newdata.content)
      // ajax
      $.post("dashboard_api.php?nav=mywork_update",newdata)
      who.modal('hide')  // 隱藏madal
    }

    function del_work(who){
        let id = $(who).parents(".modal").attr('id')
        console.log(id)
        $.post("dashboard_api.php?nav=mywork_delete",{id},function (result) {  //如果只有單一筆資料寫成{資料}
            if(result=='deleted') $(who).parents(".modal").prev().remove();
        })
    }

    // new tag
    function addtag(e) {
      if(e.keyCode==32 || e.keyCode==13){
        if(/\s/.test($(this).val())==false && $(this).val()!=""){
          $('.tagzone').append(`
          <span class="badge badge-secondary mr-1"><span>${$(this).val()}</span><a href="#" class="text-reset text-decoration-none" onclick=del_tag(this)>&times;</a></span>
          `)
          $(this).val("")
        }
        if(/\S/.test($(this).val())==true){
          let value = $(this).val().replace(/\s+/g,"")
          $('.tagzone').append(`
          <span class="badge badge-secondary mr-1"><span>${value}</span><a href="#" class="text-reset text-decoration-none" onclick=del_tag(this)>&times;</a></span>
          `)
          $(this).val("")
        }
      }
    }

    // 刪除tag
    function del_tag(who) {
      $(who).parent().remove()
    }

    // 卡片圖片符合長寬

    function adjustImg(){
      console.log(1)
      let cimg = $('.card>img')
      // let cw = cimg[0].width;
      for (let i = 0; i < $('.card>img').length; i++) {
        cimg[i].height = cimg[i].width;
      }
    }

    $(window).resize(adjustImg)

  </script>
</body>

</html>