<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\Home page\backend\homepage.php');
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <title>CODE BASE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="homepage.css" />
  <link rel="stylesheet" href="computericon.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href=<?php echo (LINK::HOMEPAGE); ?>><img src=<?php
                                                                          echo (ASSESTS::LOGO);
                                                                          ?> width="60"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto text-uppercase">
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href=<?php echo (LINK::HOMEPAGE); ?>>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=<?php echo (LINK::ABOUTUS); ?>>About</a>
        </li>

        <li class="nav-item" id="signup">
          <a class="nav-link active" aria-current="page" href=<?php echo (LINK::SIGNUP); ?>>Sign up</a>
        </li>
        <li class="nav-item" id="login">
          <a class="nav-link active" aria-current="page" href=<?php echo (LINK::LOGIN); ?>>Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=<?php echo (LINK::LEADERBOARD); ?>>Leader board</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" target="_blank" href=<?php echo (LINK::BADGECHART); ?>>Badge chart</a>
        </li>
    </div>
    <?php
    if (isset($_SESSION["Username"])) {
    ?>
      <button onclick="location.href =' <?php echo (LINK::PROFILE); ?>'" class=" btn btn-light profile-btn">
        <?php
        echo ($_SESSION["Username"]);
        ?>
      </button>
    <?php
    }
    ?>
  </nav>

  <div class="top-container align-middle text-center">
    <div class="top-content">
      <h1>Code Base</h1>
      <p>An Initiative by Anna University student!</p>
    </div>
  </div>
  <div class="middle-container">
    <div class="box1">
      <div class="wrap">
        <div class="comp">
          <div class="monitor">
            <div class="mid">
              <div class="site">
                <div class="topbar">
                  <div class="cerrar">
                    <div class="circl"></div>
                    <div class="circl"></div>
                    <div class="circl"></div>
                  </div>
                </div>
                <div class="inhead">
                  <div class="mid">
                    <div class="item"></div>
                  </div>
                  <div class="mid txr">
                    <div class="item"></div>
                    <div class="item"></div>
                    <div class="item"></div>
                    <div class="item"></div>
                  </div>
                </div>
                <div class="inslid">

                </div>
                <div class="incont">
                  <div class="item"></div>
                  <div class="item"></div>
                  <div class="item"></div>
                  <div class="item"></div>
                  <div class="wid">
                    <div class="itwid">
                      <div>
                        <div class="contfoot"></div>
                      </div>
                    </div>
                    <div class="itwid">
                      <div>
                        <div class="contfoot"></div>
                      </div>
                    </div>
                    <div class="itwid">
                      <div>
                        <div class="contfoot"></div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="infoot">

                  </div>
                </div>
              </div>
            </div>
            <div class="mid codigo">
              <div class="line">
                <div class="item var"></div>
                <div class="item cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line">
                <div class="item min var"></div>
                <div class="item min fun"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line">
                <div class="item var"></div>
                <div class="item atr"></div>
                <div class="item cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item min atr"></div>
                <div class="item lrg fun"></div>
                <div class="item min fun"></div>
                <div class="item lrg cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item lrg atr"></div>
                <div class="item min fun"></div>
                <div class="item min cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item atr"></div>
                <div class="item min fun"></div>
                <div class="item atr"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item min atr"></div>
                <div class="item min cont"></div>
                <div class="item lrg atr"></div>
                <div class="item  fun"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item min atr"></div>
                <div class="item lrg fun"></div>
                <div class="item lrg cont"></div>
                <div class="item min fun"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab2">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab2">
                <div class="item min atr"></div>
                <div class="item min fun"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab3">
                <div class="item min atr"></div>
                <div class="item min fun"></div>
                <div class="item lrg fun"></div>
                <div class="item lrg cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab3">
                <div class="item min atr"></div>
                <div class="item min fun"></div>
                <div class="item lrg atr"></div>
                <div class="item lrg cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab4">
                <div class="item min fun"></div>
                <div class="item lrg atr"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab1">
                <div class="item atr"></div>
                <div class="item var"></div>
                <div class="item cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab3">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line tab4">
                <div class="item min atr"></div>
                <div class="item min fun"></div>
                <div class="item lrg atr"></div>
                <div class="item lrg cont"></div>
                <div class="clearfix"></div>
              </div>
              <div class="line">
                <div class="item min var"></div>
                <div class="clearfix"></div>
              </div>

            </div>
          </div>
          <div class="base">
          </div>
        </div>
      </div>
    </div>
    <div class="box2">
      <div class="mid-content">
        <h1 class="text-uppercase">What is <span>Code Base </span> ?</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
      </div>
    </div>
  </div>
  <div class="bottom-container align-middle text-center">
    <div class="bottom-content">
      <h1>What else to know ?</h1>
      <p>Sign up and lets code!</p>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
  ?>
</body>

</html>