<?php
session_start();
$db = new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8', 'root', '');
$sql = 'SELECT * FROM 03_user_info WHERE acc LIKE "'.$_SESSION['user'].'"';
$rows = $db->query($sql)->fetchAll();
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
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:100,300,400,500,700,900&display=swap" rel="stylesheet">

  <!-- icon -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>gallery</title>

  <!-- animate css -->
  <link rel="stylesheet" href="./css/animate.css">

  <link rel="stylesheet" href="./css/style.css">


  <style>
    * {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .info{
      position: fixed;
      top: 12.5vh;
      right: calc(25% - 315px);
      height: 75vh;
      width:calc(25% - 100px);
    }

    .user{
      position: fixed;
      top: 25vh;
      left: calc(25% - 315px);
      height: 50vh;
      width:calc(25% - 100px);
    }

    @media (max-width: 1199.98px) {
      .info{
      position: static;
      width:100%;
      height: inherit;
      font-size: 1rem;
      }
      .user{
      position: static;
      width:100%;
      height: inherit;
      font-size: 1rem;
      }
    }


    .userphoto{
      background-color: #000;
      width: 150px;
      height: 150px;
      border: 1px solid #000;
      border-radius: 75px;
    }

    .line {
      height: 1px;
      width: 100%;
      background-color: #000;
      animation: linegrow 1s ;
    }

    @keyframes linegrow {
      0%{
        width: 0%;
      }
      100%{
        width: 100%;
      }
    }


  </style>
</head>

<body>
  <!-- nav-bar -->
  <div class="container-fluid bg-white fixed-top ">
    <!-- top-nav-bar -->
    <div class="row">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="explore.php">Gathere</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item" style="width: 100px">
                <a class="nav-link" href="mypage.html?id=<?=$rows[0]['acc']?>">我的主頁</a>
              </li>
            </ul>
            <!-- signIN -->
            <?php
            if(empty($_SESSION['user'])){
              echo '<div class="col-auto d-lg-none">登入</div>';
            }else{
              echo'
                <div class="row d-lg-none" style="padding:1rem">
                  <div class="col-auto  p-0">
                    <img src="'.$rows[0]["user_img"].'" class="rounded-circle" style="width:40px;height:40px;object-fit:cover">
                  </div>
                  <div class="col-auto h-100 my-auto">
                    <a href="dashboard.php" class="d-block my-auto text-decoration-none text-muted">'.$rows[0]["name"].'</a>
                  </div>
                  <div class="col-auto h-100 my-auto">
                    <p class="my-auto btn-sm btn-secondary">登出</p>
                  </div>
                </div>
              ';
            }
            ?>

            <form action="explore.php" method="get" class="form-inline m-0  my-2 my-lg-0 w-100">
              <input id="search-input" class="form-control form-control-sm ml-lg-auto ml-0 mr-sm-2 w-75"  name="search" type="search" placeholder="Search...">
              <button class="btn btn-sm btn-outline-secondary my-2 my-sm-0" type="submit" id="search">Search</button>
            </form>

            <!-- signIN -->
            <?php
            if(empty($_SESSION['user'])){
              echo '<a href="singin.html" class="col-auto ml-2 btn-sm btn-light d-lg-block d-none">登入</a>';
            }else{
              echo'
              <div class="col-auto d-lg-block d-none">
                <a href="dashboard.php" class="my-auto text-decoration-none text-muted">｜'.$rows[0]["name"].'</a>
              </div>
              <div class="col-auto d-lg-block d-none p-0">
                <img src="'.$rows[0]["user_img"].'"class="rounded-circle" style="width:40px;height:40px;object-fit:cover">
              </div>
              <div class="col-auto d-lg-block d-none">
                <a href="logout.php" class="my-auto btn-sm btn-light">登出</a>
              </div>
              ';
            }
            ?>

          </div>
        </nav>
      </div>
    </div>
    <div class="line"></div>
  </div>
  <!-- content -->
  <div class="container-fluid" style="margin-top: 5rem;">
    <div class="grid" id="main">
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./js/jquery-3.4.1.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <!-- masonry -->
  <script src="./js/masonry.pkgd.js"></script>
  <!-- wow.jc -->
  <script src="js/wow.js"></script>

  <script>
    $(window).scrollTop(0)

<?php
if (!empty($_GET['search'])) {echo "$.getJSON('explore_api.php?search=".$_GET['search']."').done(showCard)";}
else {echo "$.getJSON('explore_api.php').done((e)=>{
  $(document).ready(showCard(e))
  
})";}
?>

    function showCard(data,userData){

      console.log(data);
      let str=""

      for (let i = 0; i < data.length; i++) {
        let tagStr=''
        let tagAry = data[i].tag.split(",")
        for (let j = 0; j < tagAry.length; j++) {
          tagStr+= `<span class="badge badge-secondary m-1">${tagAry[j]}</span>`
        }
        

        let WoH = data[i].width / data[i].height //長寬比
        let gridclass,imgcss
        if (1<WoH) {
          imgcss = "border-radius: 5px;height: 200px;width:200px;object-fit: cover;"
        }
        if (0.75<WoH && WoH<=1) {
          imgcss = "border-radius: 5px;height: 200px;object-fit: cover;"
        }
        if (0.5<WoH && WoH<=0.75) {
          gridclass = 'grid-item-h-3';
          imgcss = "border-radius: 5px;height: 300px;object-fit: cover;"
        }
        if (WoH<=0.5) {
          gridclass = 'grid-item-h-4';
          imgcss = "border-radius: 5px;height: 400px;object-fit: cover;"
        }

        str+=`
          <div class="grid-item ${gridclass} wow fadeInUp" data-wow-delay="${0.5+i/5}s">
            <div class="card border-0" style="width: 200px;">
              <a href="#e_c${+i}" data-toggle="modal" data-backdrop="true">
              <img src="${data[i].img}" class="card-img-top" style="${imgcss}">
              </a>
              <div class="card-body">
                <h5 class="card-title m-0 mb-1 ml-n1" style="font-size: 1rem;">${data[i].title}</h5>
                <p class="card-text m-0 text-truncate" style="font-size: 0.5rem;">${data[i].content}</p>
              </div>
            </div>
          </div>

          <div class="modal" id="e_c${+i}" tabindex="-1" style="background-color:rgb(255,255,255,0.5)">
            <div class="modal-dialog modal-dialog-centered mx-auto modal-lg">
                <div class="modal-content bg-transparent border-0">
                  <div class="modal-body wow fadeInUp">
                    <div class="container-fluid ">
                      <div class="row">
                        <div class="col-12">
                            <img src="${data[i].img}" class=" card-img-top card-img-size" style="object-fit:cover">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="row h-100">
                      <div class="col info fixed my-md-0 my-3 wow fadeInUp">
                        <div class="col h-75 overflow-auto bg-white border border-dark p-2 rounded mb-3">                          
                          <h5>${data[i].title}</h5>
                          <p>${data[i].content}</p>
                        </div>
                        <div class="col overflow-auto bg-white border border-dark p-2 rounded tags d-flex align-items-center flex-wrap" style="max-height:10vh">
                        ${tagStr}
                        </div>
                      </div>
                      <div class="user fixed my-md-0 my-3 p-2 wow fadeInUp">
                        <div class="row justify-content-center align-items-center flex-column flex-xl-row flex-nowrap">
                          <div class="col">
                            <div class="h-100 d-flex flex-xl-column flex-row justify-content-center align-items-center">
                              <img src="${data[i].user_img}" class="mr-3 mr-xl-0 userphoto" style="object-fit:cover"></img>
                              <div class="userinfo bg-white p-2 mt-3 rounded border border-dark" style="width:150px">
                                  <p>${data[i].acc}</p>
                                  <p>${data[i].name}</p>
                                <hr>
                                  <p>work:50</p>
                                  <p>follower:20</p>
                                  <p>following:100</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto d-flex align-items-center p-0 mr-xl-4">
                            <div class="row flex-xl-column flex-row justify-content-center align-items-center">
                              <div class="col-auto m-3 bg-white border border-dark rounded-circle" style="width:50px;height:50px"></div>
                              <div class="col-auto m-3 bg-white border border-dark rounded-circle" style="width:50px;height:50px"></div>
                              <div class="col-auto m-3 bg-white border border-dark rounded-circle" style="width:50px;height:50px"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>`
          };
          
          $('#main').append(str) 

          // masonry
          $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: 200,
            gutter: 20,
            fitWidth: true,
          });

      }
    
      $('.modal').on('shown.bs.modal',function () {
        console.log(getScrollbarWidth());
        var t = document.body.getBoundingClientRect();
        if ($(this)[0].scrollHeight > t.height) {$(this).children().css('left',getScrollbarWidth()/2)}
      })
      
    function getScrollbarWidth() {

      // Creating invisible container
      const outer = document.createElement('div');
      outer.style.visibility = 'hidden';
      outer.style.overflow = 'scroll'; // forcing scrollbar to appear
      outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
      document.body.appendChild(outer);

      // Creating inner element and placing it in the container
      const inner = document.createElement('div');
      outer.appendChild(inner);

      // Calculating difference between container's full width and the child width
      const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

      // Removing temporary elements from the DOM
      outer.parentNode.removeChild(outer);

      return scrollbarWidth;

    }

    // Animation
    new WOW().init();

  </script>
</body>

</html>