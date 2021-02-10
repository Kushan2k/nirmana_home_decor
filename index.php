<?php 
$login=false;
if(isset($_COOKIE['save_error'])){
  echo $_COOKIE['save_error'];
}
if(isset($_COOKIE['user'])){
  $login=true;
}else{
  $login=false;
}





?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kushan gayantha">
    <meta name="keywords" content="HTML/PHP/JavaScript/Css/MYSQL">
    <meta name="description"
    content="come with tape measure.We come with ideas !<br></b>
                We are your indor and outdoor,luxury window furnishing specialists, 
                with over 10 years experience">
    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/body.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0 pb-0 ">
  <div class="logo-div ml-sm-5 mb-0 ml-lg-1">
    <a href="../index.php" class="navbar-bra">
      NIRMANA<br><p>HOME DECOR</p>
      
    </a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse pb-2 pr-4" id="navbarsExample05" >
    <ul class="navbar-nav mr-auto ">
      <?php
            if($login){
              echo 
              '<li class="nav-item">
                  <a href="./php/admin.php" class="nav-link">Admin</a>
              </li>
              ';
            }




            ?>
            <li class="nav-item ">
              <a class="nav-link" href="#">Home</a>
            </li>
            
            <?php
            if(!$login){
              echo 
              '
              <li class="nav-item">
                <button type="button" class="btn btn-outline-success login">Admin</button>
              </li>
              ';
            }
            

            ?>
      
    </ul>
    
  </div>
</nav>

<!--
  <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blinds</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item disabled" href="./php/item.php?name=Aluminium Venetian Blinds">Aluminium Venetian Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Vertical Blinds">Vertical Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Outdoor Local Bamboo Blinds">Outdoor Local Bamboo Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Indoor Imported Bamboo Blinds">Indoor Imported Bamboo Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Sunscreen Roller Blinds">Sunscreen Roller Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Blackout Roller Blinds">Blackout Roller Blinds</a>
                
                <a class="dropdown-item disabled" href="./php/item.php?name=Roman Blinds">Roman Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Zebra Blinds">Zebra Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Timber Blinds">Timber Blinds</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Monsoon Blinds">Monsoon Blinds</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Curtains & Polies</a>
              <div class="dropdown-menu" aria-labelledby="dropdown05">
                <a class="dropdown-item disabled" href="./php/item.php?name=Eyelet Curtain">Eyelet Curtain</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Iron Pole">Iron Pole</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Wooden pole">Wooden pole</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=End Cap">End Cap</a>
                <a class="dropdown-item disabled" href="./php/item.php?name=Brackets">Brackets</a>
              </div>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#p">Promotions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutus">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link conatctus" href="#footer">Contact Us</a>
            </li>-->


    <?php

      if(isset($_COOKIE['save_error'])){
        echo '<p class="alert alert-warning text-center">'.$_COOKIE['save_error'].'</p>';
      }
      else if(isset($_COOKIE['error'])){
        echo '<p class="alert alert-warning text-center">'.$_COOKIE['error'].'</p>';
      }else if(isset($_SESSION['login_error'])){
        echo '<p class="alert alert-warning text-center">'.$_SESSION['login_error'].'</p>';
      }


    ?>

    <style>
      
    </style>
    
<!--
<div class="container-fluid main-content mt-1">
  <div class="login-form container mx-auto w-75 my-5 bg-light p-3">
      <div class="row ">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto mx-md-auto">
          <form action="./php/admin.php" method="POST">
            <div class="form-row">
              <div class="col-3">
                <div class="form-group">
                  <label for="email">Username</label>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <input type="text" class="form-control" name="uname" autocomplete="off" placeholder="UserName" required>
                  <small class="text-muted">Enter User User name..</small>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-3">
                <div class="form-group">
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password" required>
                  <small class="text-muted">Enter your password..</small>
                </div>
              </div>
            </div>
            <div class="form-row d-flex justify-content-between">
              <div class="form-group">
                <input type="submit" class="btn btn-outline-success" name="login" value="Login">
                <input type="reset" class="btn btn-outline-warning" value="Clear">
                
              </div>
              <div class="form-group">
                <button type="button" id="close" class="btn btn-outline-danger ">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>

  </div>

  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 100%;height: 300px;">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active intro">
          <img src="./images/logo.jpg" width="100%" height="100%" >

          <h5>Home Decor</h5>
          <p>Waruna Rathnamalala
            <br>
            076 210 1443
          </p>
          
        </div>
        <div class="carousel-item">
          <img src="./images/cover1.jpg" alt="" width="100%" height="100%">
          <div class="container">
            <div class="carousel-caption">
              <h1 style="color: rgb(53, 53, 53);">Shop</h1>
              <p style="color: rgb(29, 29, 29);">Take a look what we have.</p>
              <p><a class="btn  btn-primary" href="#shop" role="button">Shop</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./images/8.jpg" alt="" width="100%" height="100%">
          <div class="container">
            <div class="carousel-caption text-right">
              <p class="text-justify text-dark text-sm-right header-text"  >
                <b> come with tape measure.We come with ideas !<br></b>
                We are your indor and outdoor,luxury window furnishing specialists, 
                with over 10 years experience
              </p>
              <p><a class="btn  btn-outline-success" href="#aboutus" role="button">About Us</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
  </div>
  <div class=" pic-box">

    <div class="title">
      <h3 class="font-italic">-Shop By Product-</h3>
    </div>
      
    <div class="items p-2" id="shop">
      <div class="p-item">
        <img src="./images/p1.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p2.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p3.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p4.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p5.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p6.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p7.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p8.jpg" alt="Product 1" width="100%" height="100%">
      </div>
      <div class="p-item">
        <img src="./images/p9.jpg" alt="Product 1" width="100%" height="100%">
      </div>

    </div>


  </div>

  <div class="row my-3">
    <div class="col-12 " id="p">
      <img src="./images/promo.jpg" alt="" width="100%" height="200px">
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">What We offer</h1>
          <p>
            Hight quality blinds at incredible prices Add that extra touch of luxury to your home by having
            your blinds made to fit your windows prefectly.
          </p>
          <p>
            Our simple to follow measuring guide will help you accurately measure your windows so your blinds will fit
            flawlessly
          </p>
          <div class="collapse" id="offer">
            <p>
              Quality is something we pride ourselveson,but hight quality doesn,t have to mean high prices.
              With all Our operations taking place online,we're able to pass our savings onto you -giving you first-class blinds
              at the cheapest prices.
            </p>
            <p>

            </p>

        </div>
          <p><button class="btn btn-primary" role="button" data-toggle="collapse" data-target="#offer" aria-expanded="false"aria-controls="offer" >More &raquo;</button></p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
      <div class="jumbotron" id="aboutus">
        <div class="container">
          <h1 class="display-4">About Us</h1>
          <p>
            First class customer service Your opinion matters to us,and our highly-trained members of staff our on-hand
            to answer any questions or respond to any comments you may have.<br>
            We have an excellent customer rating -so contact us if have any queries and we'll be glad to help you.
          </p>
          <div class="collapse" id="discription">
            <p>
              Specialieses in custom made,affordable quality blinds and Curtains for commercial and domestic,A Stylish
              look and feel is a big part of what makes your house home. At<b> Nirmana Home Decor</b> we are experts in combining
              real craftsmanship with the precision of modern technology,to create the solutions you would like for living
              ,working or exterior spaces.
            </p>
          
              <p>
                Meticulously finished,professionally installed,designed to stand the test of time. One of Sri lanka's 
                largest providers of Window Blinds solutions<i> Nirmana Home Decor</i> offers you the ultimate levels of living comfort,light control,
                privacy and style for you home.
              </p>

          </div>
          <p><button class="btn btn-primary" role="button" data-toggle="collapse" data-target="#discription" aria-expanded="false"aria-controls="discription" >Read More.. &raquo;</button></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="pl-3 pt-1 footerdiv" style="height: auto;" id="footer">
  <div class="details">
    <h5 class="font-weight-lighter">Nirmana Home Decor</h5>
    <p>Waruna Rathnamalala<br>

    +94 76 210 1443<br>
    info@nirmanahomedecor.lk<br>
    www.nirmanahomedecor.lk</p>
    <br>
    <a href='./php/terms.html' style="margin-right:20px;" >Privacy Tearms..</a>
    <span style="color: rgb(122, 122, 122,0.7);">&copy; Nirmana home decor</span>

  </div>
</div>
 
    -->



    <script>
      document.addEventListener('DOMContentLoaded',()=>{
        let formdiv= document.querySelector('.login-form');
        let loginbtn=document.querySelector('.login');
        if(document.querySelectorAll('.alert')){
          setInterval(500,()=>{
            document.querySelectorAll('.alert').forEach(item=>{
              item.remove();
            })
          })
        }

        if(loginbtn){
          loginbtn.addEventListener('click',()=>{
          formdiv.style.display='block';
          });
        }
        
        document.querySelector('#close').addEventListener('click',()=>{
          formdiv.style.display='none';
        });
        
      });
    </script>
    <script src="./bootstrap4/jquery.js">
    </script>
    <script src="./bootstrap4/js/bootstrap.js"></script>
</body>
</html>