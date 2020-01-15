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
  <link rel="stylesheet" href="./css/bootstrap_icon.css">
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

  <!-- animate css -->
  <link rel="stylesheet" href="./css/animate.css">




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

    .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
    }
    .kv-avatar {
        display: inline-block;
    }
    .kv-avatar .file-input {
        display: table-cell;
        width: 213px;
    }
    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }

    .bootstrap-tagsinput {
      width: 100%;
      max-width: 100%;
      line-height: 22px;
      overflow-y: auto;
      overflow-x: hidden;
      height: 65px;
      cursor: text;    }

      .tagsinput-box{
          width: 85%
        }

      @media (max-width: 375px) {.tagsinput-box{width: 69%}}      

      @media (min-width: 375px) {.tagsinput-box{width: 74%}}      

      @media (min-width: 414px) {.tagsinput-box{width: 76%}}

      @media (min-width: 576px) {.tagsinput-box{width: 82%}}

      @media (min-width: 768px) {.tagsinput-box{width: 87%}}


      @media (min-width: 992px) {.tagsinput-box{width: 82%}}

      @media (min-width: 1200px) {.tagsinput-box{width: 85%}}




  </style>
</head>

<body>
  <!-- nav-bar -->
  <div class="container-fluid fixed-top wow fadeInUp">
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
                <a class="nav-link mywork" href="#">作品管理</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link mypage" href="#">我的主頁</a>
              </li>
              <li class="nav-item d-lg-none">
                <a class="nav-link upload" href="#">新增作品</a>
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
    <div class="row wow fadeIn" data-wow-delay="1s">
      <!-- <div class="col-2 d-lg-block d-none">
        <div class="row flex-column">
          <a href="#" class="col py-2 text-reset mywork">作品管理</a>
          <a href="#" class="col py-2 text-reset mypage">我的主頁</a>
          <a href="#" class="col py-2 text-reset upload ">新增作品</a>
        </div>
      </div> -->
      <div class="col-2 d-lg-block d-none">
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 mb-2 col py-2 text-reset mywork">作品管理</a>
          <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 mb-2 col py-2 text-reset mypage">我的主頁</a>
          <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 mb-2 col py-2 text-reset upload ">新增作品</a>
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

  <!-- wow.jc -->
  <script src="js/wow.js"></script>

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
      adjustImg()
    })

    // ajax
    function showData(nav){
      $.post('dashboard_api.php?nav='+nav,function(e){
          $('#main').html(e)
          $('.card_submit').click(update)
          adjustImg()
          $('#main').hide()
          $('#main').fadeIn()
          // $('.new_tag').on('keyup',addtag)
        })
    }

    function swichNav(nav){
      $.post('dashboard_api.php?nav='+nav,function(e){
          $('#main').html(e)
          $('#main').hide()
          $('#main').fadeIn()
        })
    }

    $('.mywork').on('click',(e)=>{
      e.preventDefault();
      showData('mywork');
      $(".list-group-item").removeClass('shadow')
      $(".list-group-item").eq(0).addClass('shadow')
    })

    $('.mypage').on('click',(e)=>{
      e.preventDefault();
      swichNav('mypage');
      $(".list-group-item").removeClass('shadow')
      $(".list-group-item").eq(1).addClass('shadow')
    })

    $('.upload').on('click',(e)=>{
      e.preventDefault();
      swichNav('new_work');
      $(".list-group-item").removeClass('shadow')
      $(".list-group-item").eq(2).addClass('shadow')
    })

    // ajax更新資料
    function update(e) {
      // e.preventDefault()
      let who = $(this).parents(".modal")
      
    
      let newdata = {
        id:who.attr('id'),
        title:who.find('input').eq(0).val(),
        tags:$(".tagsinput").val(),
        content:who.find('textarea').eq(0).val()
      }
      console.log(newdata.tags);
      // 處裡tags
      let tag_html=''
      let tag_ary=newdata.tags.split(',')
      for (let i = 0; i < tag_ary.length; i++) {
        let tag = tag_ary[i]
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

    // // new tag
    // function addtag(e) {
    //   if(e.keyCode==32 || e.keyCode==13){
    //     if(/\s/.test($(this).val())==false && $(this).val()!=""){
    //       $('.tagzone').append(`
    //       <span class="badge badge-secondary mr-1"><span>${$(this).val()}</span><a href="#" class="text-reset text-decoration-none" onclick=del_tag(this)>&times;</a></span>
    //       `)
    //       $(this).val("")
    //     }
    //     if(/\S/.test($(this).val())==true){
    //       let value = $(this).val().replace(/\s+/g,"")
    //       $('.tagzone').append(`
    //       <span class="badge badge-secondary mr-1"><span>${value}</span><a href="#" class="text-reset text-decoration-none" onclick=del_tag(this)>&times;</a></span>
    //       `)
    //       $(this).val("")
    //     }
    //   }
    // }

    // // 刪除tag
    // function del_tag(who) {
    //   $(who).parent().remove()
    // }

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

    // Animation
    new WOW().init();

  </script>
</body>

</html>